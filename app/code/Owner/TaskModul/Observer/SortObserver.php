<?php

namespace Owner\TaskModul\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\Manager;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class SortObserver
 * @package Owner\TaskModul\Observer
 */
class SortObserver implements ObserverInterface
{
    /**
     * @var ManagerInterface
     */
    private $manager;

    /**
     * SortObserver constructor. - ну ти зрозумів
     * @param ManagerInterface $manager
     */
    public function __construct(
        ManagerInterface $manager
    ) {
        $this->manager = $manager;
    }

    /**
     * Що тут ?
     */
    public function execute(Observer $observer)
    {
        // TODO: Implement execute() method.
        /**
         * І яка тут логіка?
         */
    }
}