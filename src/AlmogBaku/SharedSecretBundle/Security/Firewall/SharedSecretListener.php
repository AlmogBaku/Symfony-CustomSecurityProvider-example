<?php
/**
 * Created by PhpStorm.
 * User: AlmogBaku
 * Date: 05/12/2015
 * Time: 2:40 PM
 */

namespace AlmogBaku\SharedSecretBundle\Security\Firewall;


use AlmogBaku\SharedSecretBundle\Security\Authentication\Token\SharedSecretToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;

class SharedSecretListener implements ListenerInterface
{
    /** @var AuthenticationManagerInterface */
    private $securityContext;
    /** @var SecurityContextInterface */
    private $authenticationManager;


    /**
     * SharedSecretListener constructor.
     * @param SecurityContextInterface $securityContext
     * @param AuthenticationManagerInterface $authenticationManager
     */
    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
    }


    /**
     * {@inheritdoc}
     */
    public function handle(GetResponseEvent $event)
    {
        if (null === $rawToken = $this->getTokenFromRequest($event->getRequest())) {
            return;
        }

        $token = new SharedSecretToken();
        $token->setCredentials($rawToken);

        try {
            $returnValue = $this->authenticationManager->authenticate($token);

            if ($returnValue instanceof TokenInterface) {
                return $this->securityContext->setToken($returnValue);
            }

            if ($returnValue instanceof Response) {
                return $event->setResponse($returnValue);
            }
        } catch (AuthenticationException $e) {
            if (null !== $p = $e->getPrevious()) {
                $event->setResponse($p->getHttpResponse());
            }
        }
    }

    /**
     * Fetching a BASIC HTTP Auth data from a Request into a RAW Token array
     * @param Request $request
     * @return array[client_id,secret]|null
     */
    private function getTokenFromRequest(Request $request)
    {
        $token = array($request->server->get('PHP_AUTH_USER'), $request->server->get('PHP_AUTH_PW'));
        if(is_null($token[0])) return null;
        if(is_null($token[1])) return null;

        //Remove credentials from request
        $request->server->remove('PHP_AUTH_USER');
        $request->server->remove('PHP_AUTH_PW');

        return $token;
    }
}