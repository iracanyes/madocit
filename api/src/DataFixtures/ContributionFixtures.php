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
use App\Entity\Contribution;

class ContributionFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const CONTRIBUTION_REFERENCE = 'contribution';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $contribution = new Contribution();

        /* hydratation */
        $contribution->setTitle($this->faker->sentence(2));
        $contribution->setContent($this->faker->sentence(40))
            ->setRating(mt_rand(50,100))
            ->setDateCreated($this->faker->dateTimeBetween('-2years', 'now'))
            ->setDateModified($this->faker->dateTimeBetween('-2years', 'now'));


        /* HYDRATATION : RELATIONS REFERENCES */
        $contribution->setEditor($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->setGroup($this->getReference(GroupFixtures::GROUP_REFERENCE))
            ->setSubject($this->getReference(ArticleFixtures::ARTICLE_REFERENCE));



        $manager->persist($contribution);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::CONTRIBUTION_REFERENCE, $contribution);

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
            GroupFixtures::class,
        );
    }

}