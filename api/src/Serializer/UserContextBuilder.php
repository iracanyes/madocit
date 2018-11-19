<?php
/**
 * User: iracanyes
 * Description: Serialization context for User entity
 * Permet de créer un contexte pour la déserialisation de l'objet User
 * Rendant visible la propriété "banned" aux administrateurs seulements
 * https://api-platform.com/docs/core/serialization#changing-the-serialization-context-dynamically
 * Date: 10/9/18
 * Time: 12:04 PM
 */

namespace App\Serializer;

use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\User;

class UserContextBuilder implements SerializerContextBuilderInterface
{
    private $decorated;
    private $authorizationChecker;

    public function __construct(SerializerContextBuilderInterface $decorated, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->decorated = $decorated;
        $this->authorizationChecker = $authorizationChecker;
    }

    public function createFromRequest(Request $request, bool $normalization, array $extractedAttributes = null): array
    {
        $context = $this->decorated->createFromRequest($request, $normalization, $extractedAttributes);

        $resourceClass = $context["resource_class"] ?? null;

        if($resourceClass === User::class && isset($context["groups"]) && $this->authorizationChecker->isGranted("ROLE_ADMIN") && false === $normalization){
            $context["groups"][] = 'admin:input';
        }

        return $context;
    }
}