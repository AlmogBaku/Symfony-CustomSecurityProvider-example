<?php
/**
 * Created by PhpStorm.
 * User: AlmogBaku
 * Date: 05/12/2015
 * Time: 4:03 PM
 */

namespace AlmogBaku\SharedSecretBundle\DependencyInjection\Security\Factory;


use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\HttpBasicFactory;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

class SharedSecretFactory extends  HttpBasicFactory
{
    /**
     * {@inheritdoc}
     */
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.shared_secret.'.$id;
        $container->setDefinition($providerId, new DefinitionDecorator('almogbaku.shared_secret.authentication.provider'));

        $listenerId = 'security.authentication.listener.shared_secret.'.$id;
        $container->setDefinition($listenerId, new DefinitionDecorator('almogbaku.shared_secret.authentication.listener'));

        $entryPointId = $this->createEntryPoint($container, $id, $config, $defaultEntryPoint);

        return array($providerId, $listenerId, $entryPointId);
    }

    /**
     * Define the key you need to put in your `security.yml` firewall
     */
    public function getKey()
    {
        return 'shared_secret';
    }
}