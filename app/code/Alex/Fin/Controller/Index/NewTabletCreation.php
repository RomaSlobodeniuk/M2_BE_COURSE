<?php

namespace Alex\Fin\Controller\Index;

use Alex\Fin\Api\Data\TabletsInterface;
use Alex\Fin\Model\TabletsModelFactory;
use Alex\Fin\Api\TabletsRepositoryInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;

/**
 * Class NewTabletCreation
 */
class NewTabletCreation extends Action
{
    /**
     * @var TabletsFactory
     */
    private $tabletsFactory;

    /**
     * @var TabletsRepositoryInterface
     */
    private $tabletsRepository;

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
     * @param TabletsRepositoryInterface $tabletsRepository
     * @param TabletsModelFactory $tabletsFactory
     */
    public function __construct(
        Context $context,
        TabletsRepositoryInterface $tabletsRepository,
        LoggerInterface $logger,
        TabletsModelFactory $tabletsFactory,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->tabletsRepository = $tabletsRepository;
        $this->logger = $logger;
        $this->tabletsFactory = $tabletsFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $post = (array)$this->getRequest()->getPost();
        if (!empty($post)) {
            $sku = $post['SKU'];
            $desc = $post['desc'];
            $model = $post['model'];
            $brand = $post['brand'];
            $price = $post['price'];
            $alreadyPresentFlag = $this->tabletsRepository->checkBySku($sku);
            if ($alreadyPresentFlag == false) {
                /** @var TabletsInterface $tablet */
                $tablet = $this->tabletsFactory->create();
                $tablet->setTabSku($sku);
                $tablet->setDescriptions($desc);
                $tablet->setBrand($brand);
                $tablet->setModel($model);
                $tablet->setPrice($price);
                $this->tabletsRepository->save($tablet);
                $this->messageManager->addSuccessMessage('Successful tablet creation with SKU :' . $sku);
            } else {
                $this->messageManager->addErrorMessage('Tablet with entered SKU is already exists! Creation failed!');
            }
        } else {
            $this->messageManager->addErrorMessage(' Creation failed! No POST Array!');
        }

        return $this->_redirect('fin-route/index/index');
    }
}
