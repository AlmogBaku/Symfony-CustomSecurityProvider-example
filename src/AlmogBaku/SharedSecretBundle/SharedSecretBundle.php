<?php

namespace AlmogBaku\SharedSecretBundle;

use AlmogBaku\SharedSecretBundle\DependencyInjection\Security\Factory\SharedSecretFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SharedSecretBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new SharedSecretFactory());
    }
}
