<?php

namespace Slayer\Mobile\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Manufacturers
 */
class Manufacturers extends Action
{
    /**
     * Те ж саме запитання
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
