<?php

namespace Alex\Fin\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Request\Http;

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
     * @var Http
     */
    private $request;

    /**
     * @param Http $request
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Http $request,
        Context $context,
        PageFactory $resultPageFactory
    )
    {
        $this->request = $request;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $request = $this->getRequest();
        $id = $request->getParam('sortparam');
        if ($id) {
            $isInArray = in_array($id, ['color', 'price', 'casesku']);
            if (!$isInArray) {
                $this->messageManager->addNoticeMessage('Error in sortparam key! Price sorting is applied!');
            }
        }

        return $this->resultPageFactory->create();
    }
}