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
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use \Faker\Factory;
use App\Entity\Video;
use App\Entity\Image;

class VideoGrainFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const VIDEO_GRAIN_REFERENCE = 'videoGrain';

    public function __construct()
    {
        $this->faker = \Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $video = new Video();

        /* Hydratation */
        $video->setTitle($this->faker->unique()->sentence);

        $video->setCaption($this->faker->sentence(80))
            ->setUrl($this->faker->url)
            ->setEmbedUrl($this->faker->url)
            ->setSize(mt_rand(100000, 9000000))
            ->setUploadDate($this->faker->dateTimeBetween("-2 years", "now"));
        // Relations
        $video->setAssociatedSubject($this->getReference(GrainFixtures::GRAIN_REFERENCE));

        //Image
        $image = $this->createImage();
        $manager->persist($image);
        $video->setThumbnail($image);

        $manager->persist($video);

        $manager->flush();

        // Reference used by other fixture. Ex: VideoFixtures::VIDEO_REFERENCE
        $this->addReference(self::VIDEO_GRAIN_REFERENCE, $video);

    }

    public function createImage(): Image
    {
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
     * @return array
     */

    public function getDependencies()
    {
        return array(
            ImageFixtures::class,
            GrainFixtures::class,
        );
    }

}