<?php

namespace Alex\Fin\Block;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Alex\Fin\Api\TabletsCasesRepositoryInterface;
use Alex\Fin\Api\Data\TabletsCasesInterface;
use Alex\Fin\Model\TabletsCasesModelFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * В даному випадку, якщо щось не використовується - я просив це видалити
 *
 * Class NewCase
 * @package Alex\Fin\Block
 */
class NewCase extends Template
{
    private $tabletsCasesFactory;
    /**
    @var TabletsCasesRepositoryInterface
     */
    private $tabletsCasesRepository;

    /**
     *
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Initialize service
     *
     * @param Context $context
     * @param TabletsCasesRepositoryInterface $tabletsCasesRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param TabletsCasesModelFactory $tabletsCasesFactory
     * @param array $data
     */

    public function __construct(
        Context $context,
        TabletsCasesRepositoryInterface $tabletsCasesRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        TabletsCasesModelFactory $tabletsCasesFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->messageManager = $messageManager;
        $this->tabletsCasesRepository = $tabletsCasesRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->tabletsCasesFactory = $tabletsCasesFactory;
    }


    public function createCase($tabSku)
    {
        $post = (array)$this->getRequest()->getPost();

        if (!empty($post)) {
            // Retrieve your form data
            $casesku = $post['caseSKU'];
            $desc = $post['desc'];
            $brand = $post['brand'];
            $price = $post['price'];
            $color = $post['casecolor'];
            $alreadyPresentFlag = $this->tabletsCasesRepository->getPresById($casesku);

            if ($alreadyPresentFlag == false) {
                /** @var TabletsCasesInterface $case */
                $case  = $this->tabletsCasesFactory->create();
                $case ->setForTabSku($tabSku);
                $case->setCaseSku($casesku);
                $case ->setDescription($desc);
                $case ->setBrand($brand);
                $case ->setColor($color);
                $case ->setPrice($price);
                $this->tabletsCasesRepository->save($case);
                $this->messageManager->addSuccessMessage('Succesfull case creation with SKU :' . $casesku);
            } else {
                $this->messageManager->addErrorMessage('Case with entered SKU is already exists! Creation failed!');
            }
        }
    }
}