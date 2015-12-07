<?php
/**
 * Created by PhpStorm.
 * User: AlmogBaku
 * Date: 05/12/2015
 * Time: 3:27 PM
 */

namespace AlmogBaku\SharedSecretBundle\Security\Authentication\Provider;


use AlmogBaku\SharedSecretBundle\Security\Authentication\Token\SharedSecretToken;
use FOS\OAuthServerBundle\Storage\OAuthStorage;
use OAuth2\OAuth2;
use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class SharedSecretProvider implements AuthenticationProviderInterface
{
    /** @var OAuthStorage */
    private $storage;

    /**
     * SharedSecretProvider constructor.
     * @param OAuthStorage $storage
     */
    public function __construct(OAuthStorage $storage)
    {
        $this->storage = $storage;
    }


    /**
     * {@inheritdoc}
     */
    public function supports(TokenInterface $token)
    {
        return $token instanceof SharedSecretToken;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(TokenInterface $token)
    {
        $credentials = $token->getCredentials();

        if (is_null($credentials)) {
            throw new AuthenticationException(OAuth2::HTTP_BAD_REQUEST, null, 'Empty credentials');
        }

        $client = $this->storage->getClient($credentials[0]);
        if (is_null($client)) {
            throw new AuthenticationException(OAuth2::ERROR_INVALID_CLIENT);
        }
        if ($this->storage->checkClientCredentials($client, $credentials[1]) === false) {
            throw new AuthenticationException(OAuth2::ERROR_INVALID_CLIENT);
        }

        $token->eraseCredentials();

        $newToken = new SharedSecretToken(array("ROLE_SHARED_SECRET", "ROLE_OAUTH_CLIENT"));
        $newToken->setClient($client);
        $newToken->setAuthenticated(true);
        return $newToken;
    }
}