<?php
/**
 *
 * First, your BlogPostCollectionDataProvider has to implement the CollectionDataProviderInterface:
 *
 * The getCollection method must return an array, a Traversable
 * or a ApiPlatform\Core\DataProvider\PaginatorInterface instance.
 * If no data is available, you should return an empty array.
 */

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;

final class ArticleCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Article::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null): \Generator
    {

        $data = $this->entityManager->getRepository(Article::class)
            ->findAllWithEditorImage();

        yield $data;

        // Retrieve Article post collection from somewhere
        //yield new Article(1);
        //yield new Article(2);
    }

}

?>