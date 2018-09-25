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
use App\Entity\Sanction;

class SanctionFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const SANCTION_REFERENCE = 'sanction';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $sanction = new Sanction();

        /* hydratation */
        $sanction->setType($this->faker->unique()->title)
            ->setDuration($this->faker->dateTimeBetween('now','1 years'))
            ->setStatus('active')
            ->setDateCreated($this->faker->dateTimeBetween('-2years', 'now'));

        /* Sanction's relations */
        $sanction->setEditor($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->setModerator($this->getReference(ModeratorFixtures::MODERATOR_REFERENCE))
            ->addAbuse($this->getReference(AbuseFixtures::ABUSE_REFERENCE));

        $manager->persist($sanction);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::SANCTION_REFERENCE, $sanction);

    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */

    public function getDependencies()
    {
        return array(
            EditorFixtures::class,
            AbuseFixtures::class,
            ModeratorFixtures::class,
        );
    }


}