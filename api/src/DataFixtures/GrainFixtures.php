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
use App\Entity\Grain;

class GrainFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const GRAIN_REFERENCE = 'grain';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $grain = new Grain();

        /* hydratation */

        // Subject's Data
        $grain->setTitle($this->faker->unique()->sentence);

        $grain->setDescription($this->faker->sentence(100));
         $grain->setDependencies($this->faker->sentence(40))
            ->setProficiencyLevel($this->faker->sentence)
            ->setIsValid(false);
            //->setSubjectType("grain");

        // Grain's data
        $grain->setContent($this->faker->sentence(20))
            ->setDateCreated($this->faker->dateTimeBetween("-2 years","now"))
            ->setDateModified($this->faker->dateTimeBetween("-2 years","now"))
            ->setDatePublished($this->faker->dateTimeBetween("-2 years","now"))
            ->setDraft(false)
            ->setRating(mt_rand(50,100));

        /* HYDRATATION : RELATIONS REFERENCES */
        // Subject's relations
        $grain->setAuthor($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->addCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE))
            ->addTheme($this->getReference(ThemeFixtures::THEME_REFERENCE))
            ->addVersion($this->getReference(VersionFixtures::VERSION_REFERENCE))
            ->addImage($this->getReference(ImageFixtures::IMAGE_REFERENCE));




        $manager->persist($grain);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::GRAIN_REFERENCE, $grain);


    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
            EditorFixtures::class,
        );
    }


}