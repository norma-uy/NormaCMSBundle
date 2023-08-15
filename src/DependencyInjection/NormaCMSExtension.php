<?php

namespace NormaUy\Bundle\NormaCMSBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
class NormaCMSExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new NormaCMSConfiguration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter($this->getAlias() . '.recaptcha.enable', $config['recaptcha']['enable']);
        $container->setParameter($this->getAlias() . '.pages.permalink', $config['pages']['permalink']);

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.php');
        $loader->load('recaptcha.php');
    }

    public function getAlias(): string
    {
        return 'norma_cms_bundle';
    }
}
