<?php

namespace Roma\Game\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Roma\Game\ViewModel\CreateEvents;

/**
 * For getting game id by using post
 *
 * Class GameLicense
 */
class GameLicense extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var CreateEvents
     */
    private $eventMaker;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param CreateEvents $createEvents
     * @param LoggerInterface $logger
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        CreateEvents $createEvents,
        LoggerInterface $logger,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->eventMaker = $createEvents;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        try {
            $post = (array)$this->getRequest()->getPost();
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot get game id by using getPost() "'. $exception->getMessage() . '"');
        }

        $resultPage = $this->resultPageFactory->create();

        if (!empty($post)) {
            $checkGame = $post['gamelicense'];
            $this->eventMaker->getGameID($checkGame);
            // Display the success form validation message
            $this->messageManager->addSuccessMessage('Checking...');
            $resultPage->getLayout()
                ->getBlock('custom.check.games.block')
                ->setGameId($checkGame);
        }

        return $resultPage;
    }
}