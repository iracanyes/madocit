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
use App\Entity\Chat;

class ChatFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const CHAT_REFERENCE = 'chat';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $chat = new Chat();

        /* hydratation */
        $chat->setTitle($this->faker->unique()->sentence)
            ->setStatus("open")
            ->setClosed(false)
            ->setDownvoteCount(random_int(50,100))
            ->setUpvoteCount(random_int(50,100))
            ->setAggregateRating(random_int(50,100));


        /* HYDRATATION : RELATIONS REFERENCES */
        $chat->setCreator($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->setSubject($this->getReference(ArticleFixtures::ARTICLE_REFERENCE));



        $manager->persist($chat);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::CHAT_REFERENCE, $chat);

    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */

    public function getDependencies()
    {
        return array(
            EditorFixtures::class,
            ArticleFixtures::class,

        );
    }


}