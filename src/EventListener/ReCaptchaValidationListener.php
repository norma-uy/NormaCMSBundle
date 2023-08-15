<?php

namespace NormaUy\Bundle\NormaCMSBundle\EventListener;

use ReCaptcha\ReCaptcha;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\Request;
use function Symfony\Component\Translation\t;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
class ReCaptchaValidationListener implements EventSubscriberInterface
{
    public function __construct(private ReCaptcha $reCaptcha)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::POST_SUBMIT => 'onPostSubmit',
        ];
    }

    public function onPostSubmit(FormEvent $event): void
    {
        $request = Request::createFromGlobals();

        $result = $this->reCaptcha
            ->setExpectedHostname($request->getHost())
            ->verify($request->request->get('g-recaptcha-response'), $request->getClientIp());

        if (!$result->isSuccess()) {
            $event->getForm()->addError(new FormError(t('recaptcha.invalid_captcha', domain: 'NormaCMSBundle')));
        }
    }
}
