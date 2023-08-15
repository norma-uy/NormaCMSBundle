<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use NormaUy\Bundle\NormaCMSBundle\Service\FileUploader;
use NormaUy\Bundle\NormaCMSBundle\Service\ImageOptimizer;
use NormaUy\Bundle\NormaCMSBundle\Service\Utils;
use NormaUy\Bundle\NormaCMSBundle\Twig\NormaCMSTwigExtension;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()->private();

    $services
        ->set(Utils::class)->public()
        ->set(FileUploader::class)->public()
        ->set(ImageOptimizer::class)->public()

        //Twing extensions
        ->set(NormaCMSTwigExtension::class)
        ->arg(0, service(ParameterBagInterface::class))
        ->tag('twig.extension');
};
