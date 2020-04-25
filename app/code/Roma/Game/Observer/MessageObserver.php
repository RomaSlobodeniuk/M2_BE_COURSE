<?php

namespace Roma\Game\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class MyCustomObserver
 */
class MessageObserver implements ObserverInterface
{
    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        ManagerInterface $messageManager
    ) {
        $this->messageManager = $messageManager;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(Observer $observer)
    {
        /**
         * Навіщо ця строка? змінна $event ніде не використовується
         */
        $event = $observer->getEvent();

        $message = "You are going to see customer`s games now";
        $this->messageManager->addSuccessMessage($message);
    }
}