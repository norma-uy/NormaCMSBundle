<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use NormaUy\Bundle\NormaCMSBundle\EventListener\ReCaptchaValidationListener;
use NormaUy\Bundle\NormaCMSBundle\Form\ReCaptchaType;
use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod;
use ReCaptcha\RequestMethod\CurlPost;

return static function (ContainerConfigurator $container) {
	$services = $container->services()
		->defaults()->private();

	$services
		->set('ReCaptcha\\RequestMethod\\Curl', null)->public()
		->set('ReCaptcha\\RequestMethod\\CurlPost', null)->public()
		->set('ReCaptcha\\RequestMethod', CurlPost::class)->public()

		->set(ReCaptcha::class)->public()
		->arg('$secret', env('GOOGLE_RECAPTCHA_SECRET'))
		->arg('$requestMethod', service(RequestMethod::class))

		//Forms
		->set(ReCaptchaType::class)->public()
		->arg(0, service(ReCaptcha::class))

		//EventListeners
		->set(ReCaptchaValidationListener::class)
		->arg(0, service(ReCaptcha::class))
		->tag('kernel.event_subscriber');
};
