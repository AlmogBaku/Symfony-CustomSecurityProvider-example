<?php
/**
 * Created by PhpStorm.
 * User: AlmogBaku
 * Date: 05/12/2015
 * Time: 2:36 PM
 */

namespace AlmogBaku\SharedSecretBundle\Security\Authentication\Token;


use OAuth2\Model\OAuth2Client;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;

class SharedSecretToken extends AbstractToken
{
    /** @var OAuth2Client*/
    protected $client;

    /** @var array[raw_client, raw_secret] */
    private $token;

    /**
     * @param $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return OAuth2Client
     */
    public function getClient()
    {
        return $this->client;
    }


    /**
     * @param $token
     */
    public function setCredentials($token)
    {
        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials()
    {
        return $this->token;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        $this->token = null;
    }

}