<?php
/**
 * Created by PhpStorm.
 * User: iracanyes
 * Date: 9/17/18
 * Time: 4:14 PM
 */

namespace App\DataFixtures;

use App\Entity\Chat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use \Faker\Factory;
use App\Entity\EditorsChats;

class EditorsChatsFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const EDITORS_CHATS_REFERENCE = 'editorsChats';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $editorsChats = new EditorsChats();

        /* hydratation */
        $editorsChats->setNbUnreadMessages(random_int(1,10));

        /* Editor's chats relations */
        $editorsChats->setEditor($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->setChatroom($this->getReference(ChatFixtures::CHAT_REFERENCE));



        $manager->persist($editorsChats);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::EDITORS_CHATS_REFERENCE, $editorsChats);

    }

    public function createChatroom(): Chat
    {

    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */

    public function getDependencies()
    {
        return array(
            EditorFixtures::class,
            ChatFixtures::class,
        );
    }

}