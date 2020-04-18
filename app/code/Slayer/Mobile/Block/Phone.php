<?php

namespace Slayer\Mobile\Block;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Slayer\Mobile\Api\PhoneRepositoryInterface;
use Slayer\Mobile\Api\Data\PhoneInterface;

/**
 * Class Phone
 */
class Phone extends Template
{
    /**
     * @var PhoneRepositoryInterface
     */
    private $phoneRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @var PhoneInterface[]|null
     */
    private $phones;

    /**
     * @param Context $context
     * @param PhoneRepositoryInterface $phoneRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        PhoneRepositoryInterface $phoneRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->phoneRepository = $phoneRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * @return Template
     */
    protected function _prepareLayout()
    {
        /** @var Http $request */
        $request = $this->getRequest();
        $manufacturerId = (int)$request->getParam(PhoneInterface::MANUFACTURER_ID);
        if ($manufacturerId > 0 && $this->phones === null) {
            $this->phones = [];
            try {
                /** @var SortOrder $sortOrder */
                $sortOrder = $this->sortOrderBuilder
                    ->setField(PhoneInterface::CREATED_AT)
                    ->setDirection(SortOrder::SORT_DESC)
                    ->create();
                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addFilter(PhoneInterface::MANUFACTURER_ID, $manufacturerId)
                    ->addFilter('released', null, 'neq')
                    ->addSortOrder($sortOrder)
                    ->create();
                /** @var SearchResultsInterface $searchResults */
                $searchResults = $this->phoneRepository->getList($searchCriteria);
                if ($searchResults->getTotalCount() > 0) {
                    $this->phones = $searchResults->getItems();
                }
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
                $text = 'Phones loading has failed: message "%s"';
                $message = sprintf($text, $error);
                $this->_logger->debug($message);
            }
        }

        return parent::_prepareLayout();
    }

    /**
     * @return PhoneInterface[]|null
     */
    public function getPhones()
    {
        return $this->phones;
    }
}
