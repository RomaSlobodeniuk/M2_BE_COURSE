<?php

namespace Roma\Game\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

/**
 * Ці класи ніде тут в контроллері не використовуються, видалити або добавити
 * туди, де вони використовуються
 */
use Magento\Framework\Controller\ResultFactory;
use Magento\Setup\Exception;

use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Roma\Game\ViewModel\CreateEvents;

/**
 * Class CheckGame
 */
class CheckGame extends Action
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
     * А тут що ?
     */
    private $logger;
    /**
     * @param Context $context
     * @param CreateEvents $createEvents
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        CreateEvents $createEvents,
        \Psr\Log\LoggerInterface $logger, // винести в use
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->eventMaker=$createEvents;
        $this->logger=$logger;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        try{
            $post = (array)$this->getRequest()->getPost();
            $resultPage = $this->resultPageFactory->create();
        }
        catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }


        if (!empty($post)) {
            $this->eventMaker->check_game_license();
            // Retrieve your form data
            $checkGame = $post['checkGame'];
            // Display the succes form validation message
            $this->messageManager->addSuccessMessage('Checking...');

            // Redirect to your form page (or anywhere you want...)
            //$resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
           // $resultRedirect->setUrl('/game-route/index/checkgame');
           // return $resultRedirect;
            $resultPage->getLayout()
                ->getBlock('custom.check.games.block')->setGameId($checkGame);
        }
        // 2. GET request : Render the booking page
        //$this->_view->loadLayout();
        // $this->_view->renderLayout();
        return $resultPage;

    }
}