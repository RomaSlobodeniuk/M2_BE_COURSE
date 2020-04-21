<?php

namespace Alex\Fin\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Newtablet - camel case! -> NewTablet
 */
/**
 * Форматування коду!
 */
class Newtablet extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        array $data = []
    ) {
        /**
         * Помилка висвічується на рівні phpStorm! - тільки $context повинен бути
         * переданий у батьківський конструктор
         */
        parent::__construct($context, $data);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute()
    {
        $post = (array)$this->getRequest()->getPost();
        if (!empty($post)) {
            if (!isset($post['stayOrNot']))
            {
                $this->_redirect('fin-route/index/index');
            }
        }
       return $this->resultPageFactory->create();
    }
}