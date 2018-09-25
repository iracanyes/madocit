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
use App\Entity\Group;

class GroupFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const GROUP_REFERENCE = 'group';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $group = new Group();

        /* hydratation */
        $group->setName($this->faker->unique()->word);

        gc_collect_cycles();

        $group->setDescription($this->faker->sentence(30));



        /* HYDRATATION : RELATIONS REFERENCES */
        $group->setOwner($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->addMember($this->getReference(EditorFixtures::EDITOR_REFERENCE));
            //->addContribution($this->getReference(ContributionFixtures::CONTRIBUTION_REFERENCE));




        $manager->persist($group);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::GROUP_REFERENCE, $group);

    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */

    public function getDependencies()
    {
        return array(
            EditorFixtures::class,
        );
    }


}