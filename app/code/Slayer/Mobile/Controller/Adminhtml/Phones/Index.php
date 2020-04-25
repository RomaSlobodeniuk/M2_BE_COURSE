<?php

namespace Slayer\Test\Controller\Adminhtml\Customers;

/**
 * Не став бек-слеш (\) перед шляхом до класу в use
 * Усі юзи мають бути відсортовані по алфавіту
 */
use Magento\Backend\App\Action as BackendAction;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
abstract class Index extends BackendAction implements HttpGetActionInterface
{
    /**
     * {@inheritdoc}
     */
    const ADMIN_RESOURCE = 'Slayer_Test::slayer_manage_customers';

    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Initialize Group Controller - не критично, але цей коментар лишній в констракті
     *
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
     * Customers list
     *
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE);
        $resultPage->getConfig()->getTitle()->prepend(__('My customers'));
        $resultPage->addBreadcrumb(__('My Customers'), __('My Customers'));
        $resultPage->addBreadcrumb(__('Customers'), __('Customers'));
        return $resultPage;
    }
}
