<?php

namespace Alex\Fin\Controller\Index;

use Alex\Fin\Api\Data\TabletsCasesInterface;
use Alex\Fin\Model\TabletsCasesModelFactory;
use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

/**
 * Class NewCaseCreation
 */
class NewCaseCreation extends Action
{
    /**
     * @var TabletsCasesFactory
     */
    private $tabletsCasesFactory;

    /**
     * @var TabletsCasesRepositoryInterface
     */
    private $tabletsCasesRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param LoggerInterface $logger
     * @param TabletsCasesRepositoryInterface $tabletsCasesRepository
     * @param TabletsCasesModelFactory $tabletsCasesFactory
     */
    public function __construct(
        Context $context,
        TabletsCasesRepositoryInterface $tabletsCasesRepository,
        LoggerInterface $logger,
        TabletsCasesModelFactory $tabletsCasesFactory,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->tabletsCasesRepository = $tabletsCasesRepository;
        $this->logger = $logger;
        $this->tabletsCasesFactory = $tabletsCasesFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        try {
            $post = (array)$this->getRequest()->getPost();
            if (!empty($post)) {
                $caseSku = $post['case_sku'];
                $desc = $post['desc'];
                $tabSku = (int)$post['tab_sku'];
                $brand = $post['brand'];
                $price = $post['price'];
                $color = $post['case_color'];
                $alreadyPresentFlag = $this->tabletsCasesRepository->checkBySku($caseSku);
                if ($alreadyPresentFlag == false) {
                    /** @var TabletsCasesInterface $case */
                    $case = $this->tabletsCasesFactory->create();
                    $case->setForTabSku($tabSku);
                    $case->setCaseSku($caseSku);
                    $case->setDescription($desc);
                    $case->setBrand($brand);
                    $case->setColor($color);
                    $case->setPrice($price);
                    $this->tabletsCasesRepository->save($case);
                    $this->messageManager->addSuccessMessage('Successful case creation with SKU :' . $caseSku);
                } else {
                    $this->messageManager->addErrorMessage('Case with entered SKU is already exists! Creation failed!');
                }
            } else {
                $this->messageManager->addErrorMessage('Creation failed!');
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
            $this->logger->debug($error);
        }

        if (!isset($post['stayOrNot'])) {
            return $this->_redirect('fin-route/index/index');
        } else {
            return $this->_redirect($this->_redirect->getRefererUrl());
        }
    }
}