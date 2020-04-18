<?php

namespace Roma\Test\Observer;

use Magento\Checkout\Helper\Data as CheckoutHelper;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\App\Action\Action;

/**
 * Class CheckoutObserver
 */
class CheckoutObserver implements ObserverInterface
{
    /**
     * @var ManagerInterface
     */
    private $messageManager;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var ActionFlag
     */
    private $actionFlag;

    /**
     * @var CustomerSession
     */
    private $customerSession;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @param ManagerInterface $messageManager
     * @param ScopeConfigInterface $scopeInterface
     * @param StoreManagerInterface $storeManager
     * @param ActionFlag $actionFlag
     * @param CustomerSession $customerSession
     * @param UrlInterface $url
     */
    public function __construct(
        ManagerInterface $messageManager,
        ScopeConfigInterface $scopeInterface,
        StoreManagerInterface $storeManager,
        ActionFlag $actionFlag,
        CustomerSession $customerSession,
        UrlInterface $url
    ) {
        $this->messageManager = $messageManager;
        $this->scopeConfig = $scopeInterface;
        $this->storeManager = $storeManager;
        $this->actionFlag = $actionFlag;
        $this->customerSession = $customerSession;
        $this->url = $url;
    }

    /**
     * {@inheritDoc}
     */
    public function execute(Observer $observer)
    {
        $store = $this->storeManager->getStore();
        $storeId  = $store->getId();

        $isGuest = !$this->customerSession->isLoggedIn();
        $guestCheckout = $this->scopeConfig->isSetFlag(
            CheckoutHelper::XML_PATH_GUEST_CHECKOUT,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );

        if ($isGuest && !$guestCheckout) {
            $this->messageManager->addErrorMessage(__('Guest checkout is disabled! From My Observer!'));
            $url = $this->url->getUrl('checkout/cart');

            /**
             * Stop further processing if your condition is met
             */
            $this->actionFlag->set('', Action::FLAG_NO_DISPATCH, true);
            $observer->getControllerAction()->getResponse()->setRedirect($url);
        }

        return $this;
    }
}
