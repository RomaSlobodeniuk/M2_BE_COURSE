<?php

namespace Alex\Fin\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Alex\Fin\Api\TabletsRepositoryInterface;
use Alex\Fin\Api\Data\TabletsCasesInterface;
use Alex\Fin\Model\TabletsCasesModelFactory;
use Alex\Fin\Model\TabletsCasesModel;
use Alex\Fin\Model\ResourceModel\TabletsCases\CollectionFactory as TabletsCasesCollectionFactory;
use Alex\Fin\Model\ExternalApi;

/**
 * Рекомендації:
 *
 * 1. Сортування класів в use за алфавітом
 * 2. Doc блоки до кожного з властивостей та методів
 * 2. Повні назви класів повинні бути винесені в use
 * 3. Форматування коду
 * 4. Ніяких echo в _prepareLayout()!
 */
class TabletsCases extends Template
{
    /**
     * @var \Alex\Fin\Model\ExternalApi|null // винести в use
     */
    protected $externalApi;

    /**
     * Що це? не бачу
     */
    private $tabletsCasesFactory;

     /**
     * @var TabletsCasesCollectionFactory
     */
    private $tabletsCasesCollectionFactory;

    /**
     * @var \Alex\Fin\Model\ResourceModel\TabletsCases\Collection|null // винести в use
     */
    private $tabletsCasesCollection;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var TabletsRepositoryInterface
     */
    private $tabletsRepository;

    /**
     * @var TabletsCasesRepositoryInterface
     */
    private $tabletsCasesRepository;

    /**
     * @var SortOrderBuilder
     */
    private $sortOrderBuilder;

    /**
     * @param TabletsCasesModelFactory $tabletsCasesFactory
     * @param Context $context
     * @param ExternalApi $externalApi
     * @param TabletsCasesCollectionFactory $tabletsCasesCollectionFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TabletsCasesRepositoryInterface $tabletsCasesRepository
     * @param TabletsRepositoryInterface $tabletsRepository
     * @param SortOrderBuilder $sortOrderBuilder
     * @param array $data
     */
    public function __construct(
        ExternalApi $externalApi,
        Context $context,
        TabletsCasesCollectionFactory $tabletsCasesCollectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TabletsCasesRepositoryInterface $tabletsCasesRepository,
        \Magento\Framework\Message\ManagerInterface $messageManager,  // винести в use, відсутній в описі @param
        TabletsRepositoryInterface $tabletsRepository,
        TabletsCasesModelFactory $tabletsCasesFactory,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->externalApi = $externalApi;
        $this->tabletsCasesCollectionFactory = $tabletsCasesCollectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;

        /**
         * Хоч це і можливо в PHP, але краще не створювати цих змінних на "льоту",
         * потрібно її створити в класі
         */
        $this->messageManager = $messageManager;

        $this->tabletsCasesFactory = $tabletsCasesFactory;
        $this->sortOrderBuilder = $sortOrderBuilder;
        $this->tabletsCasesRepository = $tabletsCasesRepository;
        $this->tabletsRepository = $tabletsRepository;
    }

    /**
     * Preparing global layout
     *
     * You can redefine this method in child classes for changing layout
     *
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException - ніяких виключень
     * тут не повинно бути, оскільки ляже весь код, для того тут і використовується
     * try/catch!
     */
    protected function _prepareLayout()
    {
        /**
         * Рекомендації:
         *
         * 1. Видалити метод getIdRequest
         * 2. Використати закоментований код
         */
//        $request = $this->getRequest();
//        $caseId = $request->getParam(TabletsCasesModel::FORTABSKU);
//        $sortId = $request->getParam(TabletsCasesModel::SORT);
//        $sortParam = $request->getParam(TabletsCasesModel::SORTPARAM);

        $sortId = $this->getIdRequest(TabletsCasesModel::SORT);
        $sortParam = $this->getIdRequest(TabletsCasesModel::SORTPARAM);
        $caseId = $this->getIdRequest(TabletsCasesModel::FORTABSKU);

        /**
         * array() - застаріла конструкція - використовувати []
         */
        $isInArray = in_array($sortParam, array('color','price','casesku'));
        if (!$isInArray) {
            $sortParam = 'price';
        }

        if ($this->tabletsCasesCollection === null) {
            /** @var SortOrder $sortOrder */
            try {
                if ($sortId != 1) {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField($sortParam)
                        ->setDirection(SortOrder::SORT_ASC)
                        ->create();
                } else {
                    $sortOrder = $this->sortOrderBuilder
                        ->setField($sortParam)
                        ->setDirection(SortOrder::SORT_DESC)
                        ->create();
                }
            } catch (\Exception $e) {
                /**
                 * Цього тут не повинно бути! Ніяких echo !
                 */
                echo 'SortOrderExceptions : ',  $e->getMessage(), "\n";
            }

            if ($caseId != 0) {
                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder
                    ->addFilter(TabletsCasesModel::FORTABSKU, $caseId, 'eq')
                    ->addSortOrder($sortOrder)
                    ->create();
            } else {
                /** @var SearchCriteria|SearchCriteriaInterface $searchCriteria */
                $searchCriteria = $this->searchCriteriaBuilder->addSortOrder($sortOrder)->create();
            }

            /** @var SearchResults $searchResults */
            $searchResults = $this->tabletsCasesRepository->getList($searchCriteria);
            if ($searchResults->getTotalCount() > 0) {
                $this->tabletsCasesCollection = $searchResults->getItems();
            }
        }

        return parent::_prepareLayout();
    }

    /**
     * Добре зроблено, але подумай ось над чим - ти звертаєшся до цього АПІ кожного
     * разу коли берез ціну в ГРН і це в циклі, тут неважлива точність курсу в
     * мілісекундах, вона однакова, тому завдання таке - мінімізувати кількість
     * звертань до АПІ привата до 1-го
     */
    public function getExternalCurrency()
    {
       return $this->externalApi->getExternalCurrency();
    }

    /**
     * @return \Alex\Fin\Model\ResourceModel\TabletsCases\Collection|null // винести в use
     */
    public function getTabletsCasesCollection()
    {
        return $this->tabletsCasesCollection;
    }

    /**
     * Перевірив в кінці вже...
     * Цей метод немає змісту, його можна видалити
     *
     * @param string $key
     * @return int
     */
    public function getIdRequest(string $key)
    {
        /**
         * винести в use
         */
        /** @var \Magento\Framework\App\Request\Http $request */
        $request = $this->getRequest();
        $id = $request->getParam($key); // створення лишньої змінної $id
        return $id;
    }

    /**
     * Де @param?
     *
     * @return int
     */
    public function getSortParam(string $key)
    {
        $param = (int)$this->getRequest()->getParam($key);
        if ($param === 1) {
            return 0;
        }

        return 1;
    }

    /**
     * @param $caseSku // який тип в $caseSku?
     * @return bool
     */
    public function getCasePresent($caseSku)
    {
        return $this->tabletsCasesRepository->getPresById($caseSku);
    }


    /**
     * @param $tabSku // який тип в $tabSku?
     * @return bool
     */
    public function getTabPresent($tabSku)
    {
        return $this->tabletsRepository->getPresById($tabSku);
    }

    /**
     * @param $tabSku // який тип в $tabSku?
     * @throws \Magento\Framework\Exception\CouldNotSaveException - теж, ніяких виключень!
     */
    public function createCase($tabSku)
    {
        $post = (array)$this->getRequest()->getPost();

        /**
         * Ця логіка зрозуміла мені, але:
         *
         * 1. Я бачу, що цей метод використовується як `action` атрибут до форми і у мене як у розробника
         * виникає конфуз - навіщо це було зроблено? Адже `action` - атрибут, що якраз і призначений для того, щоб
         * туди помістити url екшена (тобто контроллера: http://magento2.text/my-custom-action/index/index),
         * який і буде приймати дані з форми через пост метод;
         *
         * 2. Цю логіку краще винести в окремий контроллер, з якого потім буде редірект куди тобі потрібно.
         */
        if (!empty($post)) {
            // Retrieve your form data

            /**
             * Camel Case! - $casesku -> $caseSku
             *
             * Але на відміну від змінних 'name' в інпутів має бути `case_sku`
             */
            $casesku = $post['caseSKU'];
            $desc = $post['desc'];
            $brand = $post['brand'];
            $price = $post['price'];

            /**
             * Тут теж 'name' в інпута мав би бути `case_color`
             */
            $color = $post['casecolor'];
            $alreadyPresentFlag = $this->tabletsCasesRepository->getPresById($casesku);
            if ($alreadyPresentFlag == false) {
                /** @var TabletsCasesInterface $case */
                $case  = $this->tabletsCasesFactory->create();

                /**
                 * Тут `$case ->setForTabSku($tabSku);` - пробіл лишній, має бути:
                 *
                 * $case->setForTabSku($tabSku);
                 */
                $case ->setForTabSku($tabSku);
                $case->setCaseSku($casesku);
                $case ->setDescription($desc);
                $case ->setBrand($brand);
                $case ->setColor($color);
                $case ->setPrice($price);
                $this->tabletsCasesRepository->save($case);
                $this->messageManager->addSuccessMessage('Successful case creation with SKU :' . $casesku);
            } else {
                $this->messageManager->addErrorMessage('Case with entered SKU is already exists! Creation failed!');
            }

            /**
             * Загальна рекомендація:
             *
             * 1. Винести логіку в контроллер;
             * 2. Цей метод перейменувати на щось типу `getTabletCasesActionUrl` і повернути url
             * до свого контроллера;
             * 3. У контроллері зробити відповідно редірект куди тобі потрібно після виконання
             * задуманої логіки
             */
        }
    }

    /**
     * Де Doc Блок ?
     *
     * Це теж повинно бути винесено в окремий контроллер, а функція повинна повертати потрібний Url
     */
    public function deleteCase()
    {
        $caseId = $this->getIdRequest('casesku');
        $this->tabletsCasesRepository->deleteById($caseId);
        $this->messageManager->addSuccessMessage('Case deleted - with SKU :' . $caseId);
    }
}