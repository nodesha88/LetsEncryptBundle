<?php

/**
 * This file is part of the CertLetsEncryptBundle library.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cert\LetsEncryptBundle\Tests\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\Container;
use Cert\LetsEncryptBundle\Command\CertLetsencryptCommand;

class CertLetsencryptCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $commandTester = $this->execute();

        echo $commandTester->getDisplay();
        exit;
    }

    /**
     * Execute the CertLetsEncrypt command with specific parameters.
     *
     * @param array $parameters
     * @return CommandTester
     */
    public function execute($parameters = [])
    {
        $parameters = array_merge([
            'letsencrypt' => 'php ' . __DIR__ . '/../Fixtures/mockscript-ok.php',
            'recovery_email' => 'youremail@example.org',
            'domains' => ['example.org'],
            'logs_directory' => __DIR__ . '/../Fixtures/tmp',
            'monitoring.email.enabled' => false,
            'monitoring.email.to' => [],
        ], $parameters);

        $container = new Container();

        foreach ($parameters as $name => $value) {
            $container->setParameter('cert_lets_encrypt.' . $name, $value);
        }

        $command = new CertLetsencryptCommand();
        $command->setContainer($container);

        $application = new Application();
        $application->add($command);
        $application->setAutoExit(false);

        $command = $application->find('cert:letsencrypt');

        $commandTester = new CommandTester($command);
        $commandTester->execute(['command' => $command->getName()]);

        return $commandTester;
    }
}
