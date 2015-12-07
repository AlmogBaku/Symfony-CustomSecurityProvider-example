<?php
/**
 * @author  Almog Baku
 *          almog.baku@gmail.com
 *          http://www.almogbaku.com/
 *
 * 06/05/15 22:50
 */

namespace AlmogBaku\ApiBundle\EventListener;


use FOS\OAuthServerBundle\Event\OAuthEvent;
use FOS\OAuthServerBundle\Model\AccessTokenManagerInterface;
use AlmogBaku\ApiBundle\Entity\Client;
use Symfony\Component\Security\Core\User\UserInterface;

class OAuthEventListener {
    /** @var AccessTokenManagerInterface $accessTokenManager */
    private $accessTokenManager;

    public function onPreAuthorizationProcess(OAuthEvent $event)
    {
        /** @var Client $client */
        $client = $event->getClient();
        if($client->isSkipClientAuth()) {
            $event->setAuthorizedClient(true);
        } else {
            /** @var UserInterface $user */
            $user = $event->getUser();
            //if there is already a token, don't prompt the request for the permissions again
            //@TODO need to verify you asking for the same permissions!
            $event->setAuthorizedClient(
                ($this->accessTokenManager->findTokenBy(['client'=>$client,'user'=>$user])!=null)
            );
        }
    }

    public function __construct(AccessTokenManagerInterface $accessTokenManager) {
        $this->accessTokenManager = $accessTokenManager;
    }
}