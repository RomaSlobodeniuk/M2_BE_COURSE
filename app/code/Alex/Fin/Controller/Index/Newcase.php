<?php

namespace Alex\Fin\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class NewCase
 */
class NewCase extends Action
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
        /**
         * Форматування коду!
         */
        $post = (array)$this->getRequest()->getPost();
        if (!empty($post)) {
             if (!isset($post['stayOrNot']))
             {
            $this->_redirect('fin-route/index/index');
            }
        }
        return  $this->resultPageFactory->create();
    }
}