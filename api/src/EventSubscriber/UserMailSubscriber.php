<?php
/**
 * User: iracanyes
 * Description: User Mailing on registration
 * Api Platform Core exécute une class Action qui retourne une entité ou une collection d'entité.
 * Ensuite une série d'"event listeners" sont exécutés lesquels valide les données, enregistrent les données en DB, les sérialize et crée des réponses HTTP qui les renvoit au client
 * Date: 10/9/18
 * Time: 1:09 PM
 */

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use \Swift_Mailer;

class UserMailSubscriber extends Controller implements EventSubscriberInterface
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                "sendMail",
                EventPriorities::POST_WRITE
            ],
        ];
    }

    public function sendMail(GetResponseForControllerResultEvent $event){
        $user = $event->getControllerResult();

        $method = $event->getRequest()->getMethod();

        if(!$user instanceof User || Request::METHOD_POST !== $method){
            return;
        }

        $mess = [
            "title"=> "Confirmation inscription sur madocit@be",
            "content" => $this->renderView(
                "emails/registration.html.twig",
                array("user" => $user)
            ),
        ];


        $message = (new \Swift_Message($mess["title"]))
            ->setFrom("info@iracanyes.be")
            ->setTo($user->getEmail())
            ->setBody($mess["content"], "text/html");

        $this->mailer->send($message);


    }
}