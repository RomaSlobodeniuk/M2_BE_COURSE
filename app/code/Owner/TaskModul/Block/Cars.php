<?php

namespace Owner\TaskModul\Block;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\Api\Search\SearchResult;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Owner\TaskModul\Api\Data\EngineInterface;
use Owner\TaskModul\Api\Data\CarInterface;
use Owner\TaskModul\Api\RepositoryInterface\EngineRepositoryInterface;
use Owner\TaskModul\Model\CarModel;
use Owner\TaskModul\Api\RepositoryInterface\CarRepositoryInterface;
use Owner\TaskModul\ViewModel\AdditionInfo;

/**
 * Class Cars
 * @package Owner\TaskModul\Block
 */
class Cars extends Template
{
    /**
     * @var CarInterface[]|null
     */
    private $cars;

    /**
     * @var EngineRepositoryInterface
     */
    private $engineRepository;

    /**
     * @var CarRepositoryInterface
     */
    private $carRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @var AdditionInfo
     */
    private $additionInfo;

    /**
     * @param Context $context
     * @param CarRepositoryInterface $carRepository
     * @param EngineRepositoryInterface $engineRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param AdditionInfo $additionInfo
     * @param array $data
     */
    public function __construct(
        Context $context,
        CarRepositoryInterface $carRepository,
        EngineRepositoryInterface $engineRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        AdditionInfo $additionInfo,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->carRepository = $carRepository;
        $this->engineRepository = $engineRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->additionInfo = $additionInfo;
    }

    /**
     * @inheritDoc
     */
    protected function _prepareLayout()
    {
        if ($this->cars === null) {
            $this->cars = [];

            try {
                $request = $this->getRequest();
                $engineId = (int)$request->getParam(CarModel::ENGINE_ID);
                $sortType = $this->additionInfo->useSort();

                /** @var SortOrder $sortOrder */
                $sortOrder = $this->sortOrderBuilder
                    ->setField(CarInterface::CREATED_AT)
                    ->setDirection($sortType)
                    ->create();

                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addFilter(CarModel::ENGINE_ID, $engineId)
                    ->addSortOrder($sortOrder)
                    ->create();

                /** @var SearchResult $searchResults */
                $searchResults = $this->carRepository->getList($searchCriteria);
                if ($searchResults->getTotalCount() > 0) {
                    $this->cars = $searchResults->getItems();
                }
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
                $text = sprintf('Could not load cars collection in block: %s', $error);
                $this->_logger->debug($text);
            }
        }

        return parent::_prepareLayout();
    }

    /**
     * @return CarInterface[]|null
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * @param int $engineId
     * @return EngineInterface|bool
     */
    public function getById(int $engineId)
    {
        $engine = false;

        try {
            /** @var EngineInterface $element */
            $engine = $this->engineRepository->getById($engineId);
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
            $text = sprintf('There are some error with engines: %s', $error);
            $this->_logger->debug($text);
        }

        return $engine;
    }

    /**
     * @param int $carId
     * @return mixed
     */
    public function deleteById(int $carId)
    {
        return $this->carRepository->deleteById($carId);
    }
}