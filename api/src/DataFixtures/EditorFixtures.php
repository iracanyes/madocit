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
use App\Entity\Editor;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class EditorFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @var \Faker\Generator
     */
    private $faker;

    private $encoder;

    public const EDITOR_REFERENCE = 'editor';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->faker = Factory::create('fr_FR');

        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $editor = new Editor();

        /* hydratation */
        $editor->setEmail($this->faker->email);

        // Password
        $password = $this->encoder->encodePassword($editor, 'editor');
        $editor->setPassword($password);

        // User Data
        $editor->setUserType('editor')
            ->setNbErrorConnection(0)
            ->setBanned(false)
            ->setSigninConfirmed(true)
            ->setDateRegistration($this->faker->dateTime())
            ->setApiToken($this->faker->sha1)
            ->setRoles(['ROLE_EDITOR','ROLE_MEMBER','ROLE_ALLOWED_TO_SWITCH']);

        // Editor's data
        $editor->setEmailContact($this->faker->email)
            ->setNickname($this->faker->lastName)
            ->setFamilyName($this->faker->lastName)
            ->setGivenName($this->faker->firstName)
            ->setAffiliation($this->faker->company)
            ->setAlumniOf($this->faker->company)
            ->setRateGlobal(random_int(50,100))
            ->setRateContribution(random_int(50,100))
            ->setSanctioned(false)
            ->setEditorType('editor');

        /* HYDRATATION : RELATIONS REFERENCES */
        // User's relations
        $editor->setImage($this->getReference(ImageFixtures::IMAGE_REFERENCE));
        // Editor's relations





        $manager->persist($editor);

        $manager->flush();

        // Reference used by other fixture. Ex: ImageFixtures::IMAGE_REFERENCE
        $this->addReference(self::EDITOR_REFERENCE, $editor);

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