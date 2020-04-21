<?php

namespace Alex\Fin\Block;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Alex\Fin\Api\TabletsRepositoryInterface;
use Alex\Fin\Api\Data\TabletsInterface;
use Alex\Fin\Model\TabletsModelFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * В даному випадку, якщо щось не використовується - я просив це видалити
 *
 * Class NewTablet
 * @package Alex\Fin\Block
 */
class NewTablet extends Template
{
    private $tabletsFactory;
    /**
    @var TabletsRepositoryInterface
     */
    private $tabletsRepository;

    /**
     *
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Initialize service
     *
     * @param Context $context
     * @param TabletsRepositoryInterface $tabletsRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TabletsModelFactory $tabletsFactory
     * @param array $data
     */

    public function __construct(
        Context $context,
        TabletsRepositoryInterface $tabletsRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        TabletsModelFactory $tabletsFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->tabletsRepository = $tabletsRepository;
        $this->messageManager = $messageManager;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->tabletsFactory = $tabletsFactory;
    }

    /**
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
                $this->messageManager->addSuccessMessage('Succesfull tablet creation with SKU :' . $sku);
            } else {
                $this->messageManager->addErrorMessage('Tablet with entered SKU is already exists! Creation failed!');
            }

        }
    }
}