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
use App\Entity\Note;

class NoteFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    public const NOTE_REFERENCE = 'note';

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $note = new Note();

        /* hydratation */
        // Note's data
        $note->setContent($this->faker->sentence(80));


        $note->setDateCreated($this->faker->dateTimeBetween("-2 years","now"))
            ->setDateModified($this->faker->dateTimeBetween("-2 years","now"))
            ->setRating(random_int(50,100))
            ->setIsValid(false);

        /* HYDRATATION : RELATIONS REFERENCES */
        $note->setEditor($this->getReference(EditorFixtures::EDITOR_REFERENCE))
            ->setSubject($this->getReference(ArticleFixtures::ARTICLE_REFERENCE))
            ->setModerator($this->getReference(ModeratorFixtures::MODERATOR_REFERENCE));


        $manager->persist($note);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::NOTE_REFERENCE, $note);


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
            //GrainFixtures::class,
        );
    }


}