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
use App\Entity\Moderator;
use App\Entity\Image;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ModeratorFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    private $encoder;

    public const MODERATOR_REFERENCE = 'moderator';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->faker = Factory::create('fr_FR');

        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $moderator = new Moderator();

        /* hydratation */
        $moderator->setEmail($this->faker->email);

        // Password
        $password = $this->encoder->encodePassword($moderator, 'moderator');
        $moderator->setPassword($password);

        // User Data
        $moderator->setUserType('editor')
            ->setNbErrorConnection(0)
            ->setBanned(false)
            ->setSigninConfirmed(true)
            ->setDateRegistration($this->faker->dateTime())
            ->setApiToken($this->faker->sha1)
            ->setRoles(['ROLE_MODERATOR','ROLE_EDITOR','ROLE_MEMBER','ROLE_ALLOWED_TO_SWITCH']);

        // Editor's data
        $moderator->setEmailContact($this->faker->email)
            ->setNickname($this->faker->lastName)
            ->setFamilyName($this->faker->lastName)
            ->setGivenName($this->faker->firstName)
            ->setAffiliation($this->faker->company)
            ->setAlumniOf($this->faker->company)
            ->setRateGlobal(random_int(50,100))
            ->setRateContribution(mt_rand(50,100))
            ->setSanctioned(false)
            ->setEditorType('moderator')
        ;

        // Moderator's data
        $moderator->setNbSanctionEmitted($moderator->getNbSanctionEmitted()+1)
            ->setNbNotesValidated($moderator->getNbNotesValidated() + 1)
            ->setRateModeration(random_int(50,100))
            ->setIsGlobalModerator(false);



        /* HYDRATATION : RELATIONS REFERENCES */
        // User's relations
        $image = $this->createImage();
        $manager->persist($image);

        $moderator->setImage($image);
        // Editor's relations
        $moderator->addSubjectsCreated($this->getReference(ArticleFixtures::ARTICLE_REFERENCE))
            ->addSubjectsCreated($this->getReference(GrainFixtures::GRAIN_REFERENCE));





        $manager->persist($moderator);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::MODERATOR_REFERENCE, $moderator);

    }

    public function createImage(){
        $image = new Image();

        //hydratation
        $image->setPlace(mt_rand(1,5))
            ->setTitle($this->faker->sentence)
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
            ArticleFixtures::class,
        );
    }

}