<?php

namespace Alex\Fin\Controller\Index;

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
 * Class DeleteCaseAction
 * @package Alex\Fin\Controller\Index
 */
class DeleteCaseAction extends Action
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
     * d@param LoggerInterface $logger
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
        $post = (array)$this->getRequest()->getPost();
        if (!empty($post)) {
            $caseSku = $post['case_sku'];
            if ($this->tabletsCasesRepository->deleteBySku($caseSku)) {
                $this->messageManager->addSuccessMessage('Case deleted - with SKU: ' . $caseSku);
            } else {
                $this->messageManager->addSuccessMessage('Error with case delete, SKU: ' . $caseSku);
            }
        } else {
            $this->messageManager->addSuccessMessage('POST data ERROR');
        }

        return $this->_redirect('fin-route/index/index');
    }
}