<?php

namespace Roma\Test\Controller\Adminhtml\Cars;

use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends BackendAction implements HttpGetActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Roma_Test::roma_manage_cars';

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * {@inheritDoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        if (false) {
            return $this->_redirect('backend/admin/dashboard/index/');
        }

        return parent::dispatch($request);
    }

    /**
     * Cars list
     *
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE);
        $resultPage->getConfig()->getTitle()->prepend(__('My Customer Cars'));
        $resultPage->addBreadcrumb(__('My Customer Cars'), __('My Customer Cars'));
        $resultPage->addBreadcrumb(__('Customer Cars'), __('Customer Cars'));
        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
