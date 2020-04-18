<?php

namespace Slayer\Mobile\Block;

/**
 * Цей клас ніде не використовується тут, видалити треба
 */
use Magento\Catalog\Model\Product\ProductList\Toolbar as ToolbarModel;

use Magento\Framework\App\Request\Http;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Slayer\Mobile\Api\Data\ManufacturerInterface;
use Slayer\Mobile\Api\Data\PhoneInterface;
use Slayer\Mobile\Api\ManufacturerRepositoryInterface;
use Slayer\Mobile\Model\ResourceModel\Manufacturer\Collection as ManufacturerCollection;
use Slayer\Mobile\Model\ResourceModel\Manufacturer\CollectionFactory as ManufacturerCollectionFactory;
use Slayer\Mobile\Model\ManufacturerModel;
use Slayer\Mobile\ViewModel\MobileViewModel;

/**
 * Class Manufacturer
 */
class Manufacturer extends Template
{
    const PHONES_ACTION_ROUTE = 'mobile/manufacturer/phones';

    /**
     * @var ManufacturerCollectionFactory
     */
    private $manufacturerCollectionFactory;

    /**
     * @var ManufacturerCollection|null
     */
    private $manufacturerCollection;

    /**
     * @var MobileViewModel
     */
    private $viewModel;

    /**
     * @var ManufacturerInterface[]|null
     */
    private $manufacturers;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var ManufacturerRepositoryInterface
     */
    private $manufacturerRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param Context $context
     * @param MobileViewModel $viewModel
     * @param ManufacturerCollectionFactory $manufacturerCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param ManufacturerRepositoryInterface $manufacturerRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        MobileViewModel $viewModel,
        ManufacturerCollectionFactory $manufacturerCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        ManufacturerRepositoryInterface $manufacturerRepository,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->viewModel = $viewModel;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->manufacturerCollectionFactory = $manufacturerCollectionFactory;
        $this->manufacturerRepository = $manufacturerRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * @return Template
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        /**
         * Закоментований код повинен був бути видалений :)
         */
//        if ($this->manufacturerCollection === null) {
//            $this->manufacturerCollection = $this->manufacturerCollectionFactory->create();
//            $this->manufacturerCollection->setOrder(ManufacturerModel::NAME, 'ASC');
//        }

        /** @var Http $request */
        $request = $this->getRequest();
        $sort = (int)$request->getParam(ManufacturerModel::SORT);
        if ($this->manufacturers === null) {
            $this->manufacturers = [];
            try {
                if ($sort != 1) {
                    /** @var SortOrder $sortOrder */
                    $sortOrder = $this->sortOrderBuilder
                    ->setField(ManufacturerInterface::NAME)
                    ->setDirection(SortOrder::SORT_ASC)
                    ->create();
                } else {
                    /** @var SortOrder $sortOrder */
                    $sortOrder = $this->sortOrderBuilder
                        ->setField(ManufacturerInterface::NAME)
                        ->setDirection(SortOrder::SORT_DESC)
                        ->create();
                }

                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addSortOrder($sortOrder)
                    ->create();

                /** @var SearchResultsInterface $searchResults */
                $searchResults = $this->manufacturerRepository->getList($searchCriteria);
                if ($searchResults->getTotalCount() > 0) {
                    $this->manufacturers = $searchResults->getItems();
                }

            } catch (\Exception $exception) {
                $error = $exception->getMessage();
                $text = 'Manufacturers loading has failed: message "%s"';
                $message = sprintf($text, $error);
                $this->_logger->debug($message);
            }
        }

        return parent::_prepareLayout();
    }

    /**
     * Цей метод ніде не використовується, видалити
     *
     * @return int
     */
    public function changeSortOrder()
    {
        $param = (int)$this->getRequest()->getParam(ManufacturerModel::SORT);
        if ($param == 1) {
            return 0;
        } else {
            return 1;
        }
    }

    /**
     * @return ManufacturerCollection|null
     */
    public function getManufacturerCollection()
    {
        return $this->manufacturerCollection;
    }

    /**
     * Цей метод ніде не використовується, видалити
     *
     * @return ManufacturerInterface[]|null
     */
    public function getManufacturers()
    {
        return $this->manufacturers;
    }

    /**
     * Цей метод ніде не використовується, видалити
     *
     * @param string|int $id
     * @return string
     */
    public function getPhonesUrl($id)
    {
        return $this->getUrl(
            self::PHONES_ACTION_ROUTE,
            [
                PhoneInterface::MANUFACTURER_ID => $id
            ]
        );
    }
}
