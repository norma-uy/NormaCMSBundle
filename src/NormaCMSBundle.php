<?php

namespace NormaUy\Bundle\NormaCMSBundle;

use NormaUy\Bundle\NormaCMSBundle\DependencyInjection\NormaCMSExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
class NormaCMSBundle extends AbstractBundle
{
    public const VERSION = '0.1';

    public function build(ContainerBuilder $container): void
    {
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new NormaCMSExtension();
        }
        return $this->extension;
    }
}
