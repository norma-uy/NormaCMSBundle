<?php

namespace NormaUy\Bundle\NormaCMSBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
class NormaCMSBundle extends Bundle
{
    public const VERSION = '0.1';

    public function build(ContainerBuilder $container): void
    {
    }
}