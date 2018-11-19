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
use App\Entity\Example;

class ExampleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const EXAMPLE_REFERENCE = 'example';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $example = new Example();

        /* hydratation */
        $example->setTitle($this->faker->unique()->sentence);

        gc_collect_cycles();

        $example->setContent($this->faker->sentence(40));

        gc_collect_cycles();

        $example->setRating(mt_rand(50,100))
            ->setDateCreated($this->faker->dateTimeBetween('-2years', 'now'))
            ->setDateModified($this->faker->dateTimeBetween('-2years', 'now'))
            ->setPdf($this->faker->url());


        /* HYDRATATION : RELATIONS REFERENCES */
        $example->addSubject($this->getReference(ArticleFixtures::ARTICLE_REFERENCE))
            ->addImage($this->getReference(ImageFixtures::IMAGE_REFERENCE));
        $example->setVideo($this->getReference(VideoFixtures::VIDEO_REFERENCE));



        $manager->persist($example);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::EXAMPLE_REFERENCE, $example);

    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */
    public function getDependencies()
    {
        return array(
            //ImageFixtures::class,
            VideoFixtures::class,
            ArticleFixtures::class,
        );
    }

}