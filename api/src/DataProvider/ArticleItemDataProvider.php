<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderInterface;
use ApiPlatform\Core\DataProvider\SerializerAwareDataProviderTrait;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

final class ArticleItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface, SerializerAwareDataProviderInterface
{
    use SerializerAwareDataProviderTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Article::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Article
    {
        $article = $this->entityManager->getRepository(Article::class)
            ->find($id);

        // Retrieve the article item from somewhere then return it or null if not found
        return $article;
        /*
        return $this->getSerializer()->deserialize(
            $article,
            'App\\Entity\\Article',
            //Article::class,
            'json'
        );
        */
    }
}
?>