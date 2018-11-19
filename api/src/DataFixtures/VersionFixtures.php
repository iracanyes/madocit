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
use App\Entity\Version;

class VersionFixtures extends Fixture //implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const VERSION_REFERENCE = 'version';

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $version = new Version();

        /* hydratation */
        $version->setAssemblyVersion($this->faker->domainName)
            ->setExecutableLibraryName($this->faker->company)
            ->setProgrammingModel($this->faker->sentence)
            ->setTargetPlatform($this->faker->sentence)
            ->setIsValid(true)
            ->setDateCreated($this->faker->dateTimeBetween('-2 years','now'))
            ->setAuthor($this->faker->name);

        $manager->persist($version);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::VERSION_REFERENCE, $version);

    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */
    /*
    public function getDependencies()
    {
        return array(
            //ArticleFixtures::class,
            //GrainFixtures::class,
            ChatFixtures::class,

        );
    }
    */

}