<?php
namespace AlmogBaku\ApiBundle\Command;

use FOS\OAuthServerBundle\Propel\ClientManager;
use AlmogBaku\ApiBundle\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateClientCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('almogbaku:oauth-server:client:create')
            ->setDescription('Creates a new client')
            ->addOption(
                'redirect-uri',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets redirect uri for client. Use this option multiple times to set multiple redirect URIs.',
                null
            )
            ->addOption(
                'grant-type',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
            <<<EOT
Sets allowed grant type for client. You can use this option multiple times to set multiple grant types.
    Options: authorization_code, token, password, client_credentials, refresh_token, all.
EOT
                , null
            )
            ->addOption(
                'skip-client-auth',
                null,
                InputOption::VALUE_NONE,
                'Skip permissions approval for trusted clients.',
                null
            )
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the client')
            ->setHelp(<<<EOT
The <info>%command.name%</info> command creates a new client.

<info>php %command.full_name% [--redirect-uri=...] [--grant-type=...] name</info>
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var ClientManager $clientManager */
        $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');

        /** @var Client $client */
        $client = $clientManager->createClient();

        $grant_types = $input->getOption('grant-type');
        if(($all = array_search('all', array_map('strtolower', $grant_types)))!==false) {
            unset($grant_types[$all]);
            $grant_types = array_merge($grant_types,
                ['authorization_code', 'token', 'password', 'client_credentials', 'refresh_token']
            );
        }

        if($input->getOption('skip-client-auth')) {
            $client->setSkipClientAuth(true);
        }

        $client->setRedirectUris($input->getOption('redirect-uri'));
        $client->setAllowedGrantTypes($grant_types);
        $client->setName($input->getArgument("name"));
        $clientManager->updateClient($client);

        $output->writeln(
            sprintf(
                'Added a new client with public id <info>%s</info> , secret <info>%s</info>',
                $client->getPublicId(),
                $client->getSecret()
            )
        );
    }
}