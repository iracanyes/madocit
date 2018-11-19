<?php
/**
 * Created by PhpStorm.
 * User: iracanyes
 * Date: 9/17/18
 * Time: 4:14 PM
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use \Faker\Factory;
use App\Entity\Category;
use App\Entity\Image;

class CategoryFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const CATEGORY_REFERENCE = 'category';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $category = $this->createCategory();
        $image = $this->createImage();
        $category->addImage($image);

        /* Pr Doctrine Fixtures
        $category->setSubCategories(new ArrayCollection())
            ->setSubjects(new ArrayCollection())
            ->setChatrooms(new ArrayCollection());
        */

        $manager->persist($image);
        $manager->persist($category);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::CATEGORY_REFERENCE, $category);

    }

    public function createCategory(){

        $category = new Category();

        /* hydratation */
        $category->setName($this->faker->unique(false,100000)->domainWord);


        $category->setResume($this->faker->sentence(30));
        $category->setDescription($this->faker->sentence(30));

        $category->setIsValid(false)
            ->setDateCreated($this->faker->dateTimeBetween('-2years', 'now'));


        return $category;
    }

    public function createImage(){
        $image = new Image();

        //hydratation
        $image->setPlace(mt_rand(1,5))
            ->setTitle($this->faker->title)
            ->setUrl($this->faker->imageUrl(1200,900))
            ->setAlt($this->faker->title)
            ->setSize(mt_rand(1000,10000));

        return $image;
    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */

    public function getDependencies()
    {
        return array(
            ImageFixtures::class,
        );
    }


}