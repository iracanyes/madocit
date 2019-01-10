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
use App\Entity\Admin;
use App\Entity\Image;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    private $encoder;

    public const ADMIN_REFERENCE = 'admin';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->faker = Factory::create('fr_FR');

        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();

        /* hydratation */
        $admin->setEmail($this->faker->email);

        // Password
        $password = $this->encoder->encodePassword($admin, 'admin');
        $admin->setPassword($password);

        // User Data
        $admin->setUserType('editor')
            ->setNbErrorConnection(0)
            ->setBanned(false)
            ->setSigninConfirmed(true)
            ->setDateRegistration($this->faker->dateTime())
            ->setApiToken($this->faker->sha1)
            ->setRoles(['ROLE_ADMIN','ROLE_MODERATOR','ROLE_EDITOR','ROLE_MEMBER','ROLE_ALLOWED_TO_SWITCH']);

        // Editor's data
        $admin->setEmailContact($this->faker->email)
            ->setNickname($this->faker->lastName)
            ->setFamilyName($this->faker->lastName)
            ->setGivenName($this->faker->firstName)
            ->setAffiliation($this->faker->company)
            ->setAlumniOf($this->faker->company)
            ->setRateGlobal(mt_rand(50,100))
            ->setRateContribution(mt_rand(50,100))
            ->setSanctioned(false)
            ->setEditorType('admin')
        ;

        // Admin's data
        $admin->setNbUsersBanned($admin->getNbUsersBanned() + 1);




        /* HYDRATATION : RELATIONS REFERENCES */
        // User's relations
        $image = $this->createImage();

        $manager->persist($image);

        $admin->setImage($image);
        //$admin->setImage($this->getReference(ImageFixtures::IMAGE_REFERENCE));
        // Editor's relations

        // Admin's relation
        $admin->addUsersBanned($this->getReference(EditorFixtures::EDITOR_REFERENCE));




        $manager->persist($admin);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::ADMIN_REFERENCE, $admin);

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
            EditorFixtures::class,

        );
    }


}