<?php

namespace Alex\Fin\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class DeleteCase - Форматування коду!!!!!
 */
class DeleteCase extends Action
{
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
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $post = (array)$this->getRequest()->getPost();
        if (!empty($post)) {
            if (isset($post['redir']))
            {
                $this->_redirect('fin-route/index/index');
            }
            $this->messageManager->addNoticeMessage('Case is deleted!!!');
        }
        return $this->resultPageFactory->create();
    }
}