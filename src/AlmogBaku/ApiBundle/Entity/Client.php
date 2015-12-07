<?php

namespace AlmogBaku\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\OAuthServerBundle\Entity\Client as BaseClient;

/**
 * Client
 *
 * @ORM\Table(name="API_Client")
 * @ORM\Entity
 */
class Client extends BaseClient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Client
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @var bool
     *
     * @ORM\Column(name="skip_auth", type="boolean", options={"default": false})
     */
    protected $skipClientAuth = false;

    /**
     * @return boolean
     */
    public function isSkipClientAuth()
    {
        return $this->skipClientAuth;
    }

    /**
     * @param boolean $skipClientAuth
     */
    public function setSkipClientAuth($skipClientAuth)
    {
        $this->skipClientAuth = $skipClientAuth;
    }
}
