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
use App\Entity\Theme;

class ThemeFixtures extends Fixture
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const THEME_REFERENCE = 'theme';

    public function __construct()
    {
        $this->faker = Factory::create('en_US');
    }

    public function load(ObjectManager $manager)
    {
        $theme = new Theme();

        /* hydratation */
        $nom = [];

        for($i=0; $i<= 20; $i++){
            $nom[$i] = $this->faker->unique(false, 10000000)->domainWord;
        }

        $theme->setName($nom[random_int(0,20)]);

        $theme->setDescription($this->faker->sentence(80))
            ->setIsValid(false)
            ->setDateCreated($this->faker->dateTimeBetween("-2 years", "now"));


        $manager->persist($theme);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::THEME_REFERENCE, $theme);

    }


}