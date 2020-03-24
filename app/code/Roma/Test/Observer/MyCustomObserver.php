<?php

namespace Roma\Test\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class MyCustomObserver
 */
class MyCustomObserver implements ObserverInterface
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
        $event = $observer->getEvent();
        $product = $event->getData('product');
        $date = new \DateTime('now');

        $message = __(
            'You added product with id "%1" at "%2"',
            $product->getId(),
            $date->format('F j, Y, g:i a')
        );

        $this->messageManager->addSuccessMessage($message);
    }
}
