<?php

namespace Roma\Game\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterfacey;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context,PageFactory $resultPageFactory)
    {
        $this->resultPageFactory=$resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Це що тут робить? :)
     *
     * @return ResponseInterface|ResultInterface|Page
     */

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}