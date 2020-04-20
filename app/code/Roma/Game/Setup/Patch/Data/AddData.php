<?php

namespace Roma\Game\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

/**
 * Class PutDataIntoMyNewTable
 */
class AddData implements DataPatchInterface
{
    const GAME_CUSTOMER_TABLE = 'game_customer_table';
    const GAME_TABLE = 'game_table';

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
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $data_customers = [
            [
                'entity_id' => null,
                'email' => 'michel12@gmail.com',
                'name' => 'Michael',
                'surname' => 'Ostroskiy',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'email' => 'oleksandr145@gmail.com',
                'name' => 'Oleksandr',
                'surname' => 'Kulachuk',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'email' => 'marina44@gmail.com',
                'name' => 'Marina',
                'surname' => 'Solovey',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'email' => 'irina226@gmail.com',
                'name' => 'Irina',
                'surname' => 'Varenuk',
                'created_at' => '',
            ],
        ];
        $data_games=[
            [
                'entity_id' => null,
                'game_customer_id' => 1,
                'game_id'=>13245,
                'title' => 'Metro 2033',
                'description' => 'Metro 2033 is a first-person shooter video game. It is predominantly set within the tunnels of the Moscow Metro and Metro-2 system, though some sections take place on the surface, 
                in the ruins of Moscow. The story is told through a linear single-player campaign, and important plot moments are shown during cutscenes.',
                'price'=>'210',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'game_customer_id' => 1,
                'game_id'=>13267,
                'title' => 'Stalker',
                'description' => 'S.T.A.L.K.E.R. Shadow of Chernobyl is a non-linear sandbox game. Players have relatively free reign to explore the world and have many opportunities to interact 
                with other characters. There is, however, no free-play feature after completing the game.',
                'price'=>'60',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'game_customer_id' => 2,
                'game_id'=>13546,
                'title' => 'Minecraft',
                'description' => 'Minecraft is a Lego style adventure game which has massively increased in popularity since it was released two years ago. It now has more than 33 million users worldwide.
                 The video game puts players in a randomly-generated world where they can create their own structures and contraptions out of textured cubes.',
                'price'=>'90',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'game_customer_id' => 3,
                'game_id'=>13754,
                'title' => 'The Elder Scrolls V: Skyrim',
                'description' => 'The Elder Scrolls V: Skyrim is an action role-playing game, playable from either a first or third-person perspective. The player may freely roam over the 
                land of Skyrim which is an open world environment consisting of wilderness expanses, dungeons, cities, towns, fortresses, and villages.',
                'price'=>'160',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'game_customer_id' => 4,
                'game_id'=>13352,
                'title' => 'Far Cry 3',
                'description' => 'Far Cry 3 is a 2012 first-person shooter developed by Ubisoft Montreal and published by Ubisoft. 
                It is the third main installment in the Far Cry series. The game takes place on the fictional Rook Islands, a tropical archipelago which can be freely explored by players. Gameplay focuses on combat and exploration.',
                'price'=>'120',
                'created_at' => '',
            ],
        ];
        $this->moduleDataSetup->startSetup();
        echo 'Roma_Game:PutDataIntoGameTable:Data:startSetup' . "\r\n";

        /**
         * 7. для набивки даних у таблиці використовувати тільки Patch/Data !!!
         * Ну і обов'язково ваші фабрики моделей і репозиторії для створення моделей,
         * з подальшим присвоєнням даних і збереженням цих моделей за допомогою репозиторія.
         *
         * А тут ти використав прямий інсерт через $connection
         */
        try {
            $connection = $this->moduleDataSetup->getConnection();
            foreach ($data_customers as $row) {
                $row['created_at'] = time();
                $connection->insert(self::GAME_CUSTOMER_TABLE, $row);
            }
            foreach ($data_games as $row) {
                $row['created_at'] = time();
                $connection->insert(self::GAME_TABLE, $row);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row, message: "'. $exception->getMessage() . '"');
        }

        $this->moduleDataSetup->endSetup();
        echo 'Roma_Game:PutDataIntoMyTable:Data:endSetup' . "\r\n";
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
