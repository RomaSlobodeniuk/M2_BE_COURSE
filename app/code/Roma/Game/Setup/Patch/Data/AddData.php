<?php

namespace Roma\Game\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Psr\Log\LoggerInterface;
use Roma\Game\Api\Data\GameCustomerInterface;
use Roma\Game\Api\Data\GameInterface;
use Roma\Game\Api\GameCustomerRepositoryInterface;
use Roma\Game\Api\GameRepositoryInterface;
use Roma\Game\Model\GameCustomerModelFactory;
use Roma\Game\Model\GameModelFactory;

/**
 * input data to database
 *
 * Class AddData
 */
class AddData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var GameCustomerRepositoryInterface
     */
    private $gameCustomerRepository;

    /**
     * @var GameRepositoryInterface
     */
    private $gameRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var GameCustomerModelFactory
     */
    private $gameCustomerFactory;

    /**
     * @var GameModelFactory
     */
    private $gameFactory;

    /**
     * @var DateTime
     */
    private $dateTime;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param LoggerInterface $logger
     * @param GameCustomerRepositoryInterface $gameCustomerRepository
     * @param GameCustomerModelFactory $customerModelFactory
     * @param GameModelFactory $gameFactory
     * @param GameRepositoryInterface $gameRepository
     * @param DateTime $dateTime
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        LoggerInterface $logger,
        GameCustomerRepositoryInterface $gameCustomerRepository,
        GameCustomerModelFactory $customerModelFactory,
        GameModelFactory $gameFactory,
        GameRepositoryInterface $gameRepository,
        DateTime $dateTime
    )
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->logger = $logger;
        $this->gameCustomerRepository = $gameCustomerRepository;
        $this->gameCustomerFactory = $customerModelFactory;
        $this->gameFactory = $gameFactory;
        $this->gameRepository = $gameRepository;
        $this->dateTime = $dateTime;
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
        $data_games = [
            [
                'entity_id' => null,
                'game_customer_id' => 14,
                'game_id' => 13245,
                'title' => 'Metro 2033',
                'description' => 'Metro 2033 is a first-person shooter video game. It is predominantly set within the tunnels of the Moscow Metro and Metro-2 system, though some sections take place on the surface, 
                in the ruins of Moscow. The story is told through a linear single-player campaign, and important plot moments are shown during cutscenes.',
                'price' => '210',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'game_customer_id' => 14,
                'game_id' => 13267,
                'title' => 'Stalker',
                'description' => 'S.T.A.L.K.E.R. Shadow of Chernobyl is a non-linear sandbox game. Players have relatively free reign to explore the world and have many opportunities to interact 
                with other characters. There is, however, no free-play feature after completing the game.',
                'price' => '60',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'game_customer_id' => 15,
                'game_id' => 13546,
                'title' => 'Minecraft',
                'description' => 'Minecraft is a Lego style adventure game which has massively increased in popularity since it was released two years ago. It now has more than 33 million users worldwide.
                 The video game puts players in a randomly-generated world where they can create their own structures and contraptions out of textured cubes.',
                'price' => '90',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'game_customer_id' => 16,
                'game_id' => 13754,
                'title' => 'The Elder Scrolls V: Skyrim',
                'description' => 'The Elder Scrolls V: Skyrim is an action role-playing game, playable from either a first or third-person perspective. The player may freely roam over the 
                land of Skyrim which is an open world environment consisting of wilderness expanses, dungeons, cities, towns, fortresses, and villages.',
                'price' => '160',
                'created_at' => '',
            ],
            [
                'entity_id' => null,
                'game_customer_id' => 17,
                'game_id' => 13352,
                'title' => 'Far Cry 3',
                'description' => 'Far Cry 3 is a 2012 first-person shooter developed by Ubisoft Montreal and published by Ubisoft. 
                It is the third main installment in the Far Cry series. The game takes place on the fictional Rook Islands, a tropical archipelago which can be freely explored by players. Gameplay focuses on combat and exploration.',
                'price' => '120',
                'created_at' => '',
            ],
        ];
        $this->moduleDataSetup->startSetup();
        echo 'Roma_Game:PutDataIntoGameTable:Data:startSetup' . "\r\n";

        try {
            /**
             * @var GameCustomerInterface $customer ;
             */
            foreach ($data_customers as $row) {
                $row['created_at'] = $this->dateTime->gmtDate();
                $customer = $this->gameCustomerFactory->create();
                $customer->setEmail($row['email']);
                $customer->setName($row['name']);
                $customer->setSurname($row['surname']);
                $customer->setCreatedAt($row['created_at']);
                $this->gameCustomerRepository->save($customer);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row to game customers, message: "' . $exception->getMessage() . '"');
        }

        try {
            /**
             * @var GameInterface $game ;
             */
            foreach ($data_games as $row) {
                $row['created_at'] = $this->dateTime->gmtDate();
                $game = $this->gameFactory->create();
                $game->setTitle($row['title']);
                $game->setDescription($row['description']);
                $game->setPrice($row['price']);
                $game->setGameCustomerId($row['game_customer_id']);
                $game->setGameId($row['game_id']);
                $customer->setCreatedAt($row['created_at']);
                $this->gameRepository->save($game);
            }
        } catch (\Exception $exception) {
            $this->logger->debug('Cannot insert row to game table, message: "' . $exception->getMessage() . '"');
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
