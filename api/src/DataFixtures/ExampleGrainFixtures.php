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
use App\Entity\Example;
use App\Entity\Image;
use App\Entity\Video;

class ExampleGrainFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const EXAMPLE_GRAIN_REFERENCE = 'exampleGrain';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $example = new Example();

        /* hydratation */
        $example->setTitle($this->faker->unique(false,10000)->sentence);

        gc_collect_cycles();

        $example->setContent($this->faker->sentence(40));

        gc_collect_cycles();

        $example->setRating(mt_rand(50,100))
            ->setDateCreated($this->faker->dateTimeBetween('-2years', 'now'))
            ->setDateModified($this->faker->dateTimeBetween('-2years', 'now'))
            ->setPdf($this->faker->url());


        /* HYDRATATION : RELATIONS REFERENCES */
        $example->addSubject($this->getReference(GrainFixtures::GRAIN_REFERENCE))
            ->addImage($this->getReference(ImageFixtures::IMAGE_REFERENCE));

        $video = $this->createVideo();
        //Image
        $image = $this->createImage();
        $manager->persist($image);
        $manager->flush();
        $video->setThumbnail($image);
        $manager->persist($video);
        $manager->flush();
        $example->setVideo($video);



        $manager->persist($example);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::EXAMPLE_GRAIN_REFERENCE, $example);

    }

    /**
     * @return Image
     */
    public function createImage(): Image{
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
     * @return Video
     */
    public function createVideo(): Video{

        $video = new Video();

        /* Hydratation */
        $video->setTitle($this->faker->unique()->title);
        gc_collect_cycles();

        $video->setCaption($this->faker->sentence(80))
            ->setUrl($this->faker->url)
            ->setEmbedUrl($this->faker->url)
            ->setSize(mt_rand(100000, 9000000))
            ->setUploadDate($this->faker->dateTimeBetween("-2 years", "now"));
        // Relations
        $video->setAssociatedSubject($this->getReference(ArticleFixtures::ARTICLE_REFERENCE));



        return $video;
    }

    /**
     * Permet de définir un ordre de chargement des fixtures ainsi les dépendances sont chargés avant
     * @return array
     */
    public function getDependencies()
    {
        return array(
            //ImageFixtures::class,
            VideoFixtures::class,
            GrainFixtures::class,
        );
    }

}