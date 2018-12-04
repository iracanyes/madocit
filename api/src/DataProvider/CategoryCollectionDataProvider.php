<?php


namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Category;
use App\Entity\Image;

final class CategoryCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CategoryCollectionDataProvider constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Category::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null)
    {
        $dataCateg = $this->entityManager->getRepository(Category::class)
            ->myFindAllWithImage();


        $objets = array();
        $n= 0;

        foreach ($dataCateg as $value){

            $images[$n++] = $value->getImages()[0];
        }

        yield $dataCateg;


        yield $images;


    }



}
?>