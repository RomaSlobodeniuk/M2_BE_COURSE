<?php

namespace Alex\Fin\Block;

/**
 * Тут має бути все за алфавітом
 */
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Alex\Fin\Api\Data\TabletsInterface;
use Alex\Fin\Api\TabletsRepositoryInterface;
use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Alex\Fin\Model\ResourceModel\Tablets\Collection as TabletsCollection;
use Alex\Fin\Model\ResourceModel\Tablets\CollectionFactory as TabletsCollectionFactory;
use Alex\Fin\Model\TabletsModel;
use Alex\Fin\Model\TabletsModelFactory;

/**
 * Де Doc блоки?
 */
class Tablets extends Template
{
    private $tabletsFactory;
    /**
     * @var TabletsCasesRepositoryInterface
     */
    private $tabletsCasesRepository;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var TabletsCollectionFactory
     */
    private $tabletsCollectionFactory;

    /**
     * @var TabletsCollection|null
     */
    private $tabletsCollection;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TabletsRepositoryInterface
     */
    private $tabletsRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * TabletsModelFactory $tabletsFactory, - це щось лишнє явно
     *
     * Тут вказано НЕ все, що ти передаєш у конструктор
     *
     * @param Context $context
     * @param TabletsCollectionFactory $tabletsCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TabletsCasesRepositoryInterface $tabletsCasesRepository
     * @param TabletsRepositoryInterface $tabletsRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        Context $context,
        \Psr\Log\LoggerInterface $logger, // клас винести в use
        TabletsCollectionFactory $tabletsCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TabletsCasesRepositoryInterface $tabletsCasesRepository,
        \Magento\Framework\Message\ManagerInterface $messageManager, // клас винести в use
        TabletsModelFactory $tabletsFactory, // клас винести в use
        TabletsRepositoryInterface $tabletsRepository,
        SortOrderBuilder $sortOrderBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->logger = $logger; // об'явлено динамічно, створити змінну
        $this->messageManager = $messageManager; // об'явлено динамічно, створити змінну
        $this->tabletsCollectionFactory = $tabletsCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->tabletsFactory = $tabletsFactory;
        $this->tabletsRepository = $tabletsRepository;
        $this->tabletsCasesRepository = $tabletsCasesRepository;
        $this->sortOrderBuilder = $sortOrderBuilder;
    }

    /**
     * Де Doc блок?
     */
    protected function _prepareLayout()
    {
        $request = $this->getRequest();
        $sortId = (int)$request->getParam(TabletsModel::SORT);
        if ($this->tabletsCollection === null) {
            try {
                /** @var SortOrder $sortOrder */
                if ($sortId != 1) {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField(TabletsInterface::PRICE)
                        ->setDirection(SortOrder::SORT_ASC)
                        ->create();
                } else {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField(TabletsInterface::PRICE)
                        ->setDirection(SortOrder::SORT_DESC)
                        ->create();
                }
                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addSortOrder($sortOrder)
                    ->create();

                /** @var SearchResults $searchResults */
                $searchResults = $this->tabletsRepository->getList($searchCriteria);
            } catch (\Exception $e) {
                $error = $e->getMessage();
                $this->_logger->debug($error);
            }

            /**
             * Цей блок винесений за try/catch - не є добре
             */
            if ($searchResults->getTotalCount() > 0) {
                $this->tabletsCollection = $searchResults->getItems();
            }
        }

        return parent::_prepareLayout();
    }

    /**
     * @return TabletsCollection|null
     */
    public function getTabletsCollection()
    {
        return $this->tabletsCollection;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        $this->_eventManager->dispatch('tablet_applyFilter_before');
        $qauntity = $this->scopeConfig->getValue(
            'alex_fin/settings/quanity',
            $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT,
            $scopeCode = null
        );
        return $qauntity;
    }

    /**
     * @return int
     */
    public function getSortParam()
    {
        $param = (int)$this->getRequest()->getParam(TabletsModel::SORT);
        if ($param == 1) {
            return 0;
        } else {
            return 1;
        }
    }

    public function getCasesQunatity($tablet)
    {
        return $this->tabletsCasesRepository->getCasesQunatity($tablet);
    }

    /**
     * Помилки:
     *
     * 1. Ця функція повинна щось повертати, а тут є випадки - коли нічого не повертає
     * 2. Тут не повинно бути викидів виключень, використовувати try/catch
     * 3. Форматування коду
     * 4. Ця функція не приймає ніяких параметрів, не розумію для чого тут вони описані?
     *
     * @param $sku
     * @param $descriptions
     * @param $brand
     * @param $price
     * @return bool
     * @throws \Exception
     */
    public function createTablet()
    {
        $post = (array)$this->getRequest()->getPost();
        if (!empty($post)) {
            // Retrieve your form data
            $sku = $post['SKU'];
            $desc = $post['desc'];
            $model = $post['model'];
            $brand = $post['brand'];
            $price = $post['price'];
            $alreadyPresentFlag = $this->tabletsRepository->getPresById($sku);
            if ($alreadyPresentFlag == false) {
                    /** @var TabletsInterface $tablet */
                    $tablet = $this->tabletsFactory->create();
                    $tablet->setTabSku($sku);
                    $tablet->setDescriptions($desc);
                    $tablet->setBrand($brand);
                    $tablet->setModel($model);
                    $tablet->setPrice($price);
                    $this->tabletsRepository->save($tablet);
                    $this->messageManager->addSuccessMessage('Successful tablet creation with SKU :' . $sku);
            } else {
                $this->messageManager->addErrorMessage('Tablet with entered SKU is already exists! Creation failed!');
            }
        }
    }
}
