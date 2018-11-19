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

use App\Entity\Abuse;

class AbuseFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const ABUSE_REFERENCE = 'abuse';

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $abuse = new Abuse();

        /* hydratation */
        $abuse->setType($this->faker->unique()->word);
        gc_collect_cycles();

        $abuse->setDescription($this->faker->sentence(40))
            ->setDateCreated($this->faker->dateTimeBetween('-2years', 'now'));
        /* Abuse's relations */
        $abuse->setAccuser($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->setDefendant($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->setContribution($this->getReference(ContributionFixtures::CONTRIBUTION_REFERENCE))
        ;

        $manager->persist($abuse);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::ABUSE_REFERENCE, $abuse);

    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */

    public function getDependencies()
    {
        return array(
            EditorFixtures::class,
            ContributionFixtures::class,
        );
    }



}