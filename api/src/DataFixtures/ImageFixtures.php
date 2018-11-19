<?php
/**
 * Created by PhpStorm.
 * User: dashouney
 * Date: 9/17/18
 * Time: 4:14 PM
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use \Faker\Factory;
use App\Entity\Image;

class ImageFixtures extends Fixture
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const IMAGE_REFERENCE = 'image';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $image = new Image();

        //hydratation
        $image->setPlace(mt_rand(1,5))
            ->setTitle($this->faker->sentence)
            ->setUrl($this->faker->imageUrl(1200,900))
            ->setAlt($this->faker->sentence)
            ->setSize(mt_rand(1000,10000));

        $manager->persist($image);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::IMAGE_REFERENCE, $image);

    }

}