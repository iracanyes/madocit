<?php
/**
 * Created by PhpStorm.
 * User: dashouney
 * Date: 10/9/18
 * Time: 12:24 PM
 */

namespace App\Serializer;

use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\Sanction;

class SanctionContextBuilder implements SerializerContextBuilderInterface
{
    private $decorated;
    private $authorizationChecker;

    public function __construct(SerializerContextBuilderInterface $decorated, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->decorated = $decorated;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function createFromRequest(Request $request, bool $normalization, ?array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);
        $resourceClass = $context['resource_class'] ?? null;

        if ($resourceClass === Sanction::class && isset($context['groups']) && $this->authorizationChecker->isGranted('ROLE_MODERATOR') && false === $normalization) {
            $context['groups'][] = 'moderator:input';
        }

        return $context;
    }
}