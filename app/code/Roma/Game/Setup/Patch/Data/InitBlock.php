<?php

namespace Roma\Game\Setup\Patch\Data;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class InitBlock
 */
class InitBlock implements DataPatchInterface
{
    private $blockFactory;

    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param LoggerInterface $logger
     *
     * Де BlockFactory @param?
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger,
        BlockFactory $blockFactory
    ) {
        $this->blockFactory = $blockFactory;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {

        $this->moduleDataSetup->startSetup();
        echo 'Roma_Game:startSetup' . "\r\n";


        $staticBlockInfo = [
            'title' => 'Game license check',
            'identifier' => 'roma_game_check_block',
            'stores' => ['0'],
            'is_active' => 1,
            'content' => "<a class=\"read-more\" href=\"game_route/index/checkgame\">Check now</a>"
        ];

        try {
            /**
             * Збереженням моделі за допомогою репозиторія?
             */
            $this->blockFactory->create()->setData($staticBlockInfo)->save();
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert block, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Roma_Test:endSetup' . "\r\n";
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
