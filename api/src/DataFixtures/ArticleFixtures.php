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
use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Image;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const ARTICLE_REFERENCE = 'article';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $article = new Article();

        /* hydratation */
        // Subject's Data
        $article->setTitle($this->faker->unique()->sentence)
            ->setDescription($this->faker->sentence(100))
            ->setDependencies($this->faker->sentence(40));

        $article->setProficiencyLevel($this->faker->sentence)
            ->setIsValid(false);
            //->setSubjectType("article");

        // Article's data
        $article->setArticleBody($this->faker->sentence(80));
        $article->setDateCreated($this->faker->dateTimeBetween("-2 years","now"))
            ->setDateModified($this->faker->dateTimeBetween("-2 years","now"))
            ->setDatePublished($this->faker->dateTimeBetween("-2 years","now"));

        $article->setCoursePrerequisites($this->faker->sentence(80));

        $article->setAggregateRating(random_int(50,100))
            ->setPdf($this->faker->url);

        /* HYDRATATION : RELATIONS REFERENCES */
        // Subject's relations
        $article->setAuthor($this->getReference(EditorFixtures::EDITOR_REFERENCE));

        $article->addVersion($this->getReference(VersionFixtures::VERSION_REFERENCE))
            ->addCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE))
            ->addTheme($this->getReference(ThemeFixtures::THEME_REFERENCE));

        // Image
        $image = $this->createImage();
        $manager->persist($image);

        $article->addImage($image);


        // Article's relation
        $article->addHasPart($this->getReference(GrainFixtures::GRAIN_REFERENCE));



        $manager->persist($article);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::ARTICLE_REFERENCE, $article);


    }

    public function createCategory(){

        $category = new Category();

        /* hydratation */
        $category->setName($this->faker->unique(false,100000)->word);

        /* cette méthode permet de Forcer la collecte de tous les cycles de déchets existants.
         * Permet d'éviter l'erreur généré par realText()
         * Allowed memory size of 134217728 bytes exhausted (tried to allocate 20480 bytes) in /srv/api/vendor/fzaninotto/faker/src/Faker/Provider/Text.php
         */
        gc_collect_cycles();

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
            //ImageFixtures::class,
            CategoryFixtures::class,
            GrainFixtures::class,
        );
    }

}