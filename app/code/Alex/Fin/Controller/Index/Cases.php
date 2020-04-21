<?php

namespace Alex\Fin\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Cases
 */
class Cases extends Action
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
         * Винести в use
         */
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();
        $id = $request->getParam('sortparam');

        /**
         * Форматування коду!
         */
        if ($id){
            /**
             *  array() - застаріла конструкція, використовувати []
             */
        $isInArray = in_array($id, array('color','price','casesku'));
            if(!$isInArray) {
                $this->messageManager->addNoticeMessage('Error in sortparam key! Price sorting is apply!');
            }
        }

       return $this->resultPageFactory->create();
    }
}