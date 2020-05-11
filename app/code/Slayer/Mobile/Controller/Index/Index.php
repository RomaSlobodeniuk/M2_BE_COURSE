<?php

namespace Slayer\Mobile\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Element\Template;

/**
 * Class Index
 */
class Index extends Action
{
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        $sortDirection = $this->getRequest()->getParam('sort');
        if ($sortDirection === "" || $sortDirection == null) {
            $sortDirection = 'asc';
        }

        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        /** @var Template $block */
        $block = $page->getLayout()->getBlock('manufacturer.block');
        $block->setData('sort', $sortDirection);
        return $page;
    }
}
