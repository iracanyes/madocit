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
use App\Entity\Privilege;

class PrivilegeFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const PRIVILEGE_REFERENCE = 'privilege';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $privilege = new Privilege();

        /* hydratation */
        $privilege->setType($this->faker->unique()->word);

        $privilege->setGroup($this->getReference(GroupFixtures::GROUP_REFERENCE))
            ->setSubject($this->getReference(ArticleFixtures::ARTICLE_REFERENCE));

        $manager->persist($privilege);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::PRIVILEGE_REFERENCE, $privilege);

    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */

    public function getDependencies()
    {
        return array(
            GroupFixtures::class,
            ArticleFixtures::class,
            //GrainFixtures::class,
        );
    }



}