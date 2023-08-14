<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use NormaUy\Bundle\NormaCMSBundle\EventListener\ReCaptchaValidationListener;
use NormaUy\Bundle\NormaCMSBundle\Service\FileUploader;
use NormaUy\Bundle\NormaCMSBundle\Service\ImageOptimizer;
use NormaUy\Bundle\NormaCMSBundle\Service\Utils;
use NormaUy\Bundle\NormaCMSBundle\Twig\NormaCMSTwigExtension;
use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod;
use ReCaptcha\RequestMethod\CurlPost;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()->private();

    $services
        ->set(Utils::class)->public()
        ->set(FileUploader::class)->public()
        ->set(ImageOptimizer::class)->public()

        ->set('ReCaptcha\\RequestMethod\\Curl', null)->public()
        ->set('ReCaptcha\\RequestMethod\\CurlPost', null)->public()
        ->set('ReCaptcha\\RequestMethod', CurlPost::class)->public()

        ->set(ReCaptcha::class)->public()
        ->arg('$secret', env('GOOGLE_RECAPTCHA_SECRET'))
        ->arg('$requestMethod', service(RequestMethod::class))

        //Twing extensions
        ->set(NormaCMSTwigExtension::class)
        ->arg(0, service(ParameterBagInterface::class))
        ->tag('twig.extension')

        //EventListeners
        ->set(ReCaptchaValidationListener::class)
        ->arg(0, service(ReCaptcha::class))
        ->tag('kernel.event_subscriber');
};
