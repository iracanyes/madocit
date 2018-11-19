<?php
/**
 * Created by PhpStorm.
 * User: iracanyes
 * Date: 9/17/18
 * Time: 4:14 PM
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use \Faker\Factory;
use App\Entity\Message;

class MessageFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const MESSAGE_REFERENCE = 'message';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        for($i=0; $i< 5; $i++){
            $message = $this->createMessage();

            $manager->persist($message);

            $manager->flush();
        }

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::MESSAGE_REFERENCE, $message);

    }

    public function createMessage(){

        $message = new Message();

        /* hydratation */
        $message->setContent($this->faker->sentence(20));


        $message->setDateCreated($this->faker->dateTimeBetween('-2years', 'now'))
            ->setSanctioned(true)
            ->setDownvoteCount(random_int(50,100))
            ->setUpvoteCount(random_int(50,100))
            ->setAttachmentUrl($this->faker->url())
            ->setAttachmentImage($this->faker->imageUrl(1200,900))
            ->setAttachmentFile($this->faker->url());


        /* HYDRATATION : RELATIONS REFERENCES */
        $message->setEditor($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->setChatroom($this->getReference(ChatFixtures::CHAT_REFERENCE));



        return $message;
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