<?php

namespace NormaUy\Bundle\NormaCMSBundle\Form;

use NormaUy\Bundle\NormaCMSBundle\EventListener\ReCaptchaValidationListener;
use ReCaptcha\ReCaptcha;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
class ReCaptchaType extends AbstractType
{
    /**
     * @var ReCaptcha
     */
    private $reCaptcha;

    /**
     * ReCaptchaType constructor.
     *
     * @param ReCaptcha $reCaptcha
     */
    public function __construct(ReCaptcha $reCaptcha)
    {
        $this->reCaptcha = $reCaptcha;
    }

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventSubscriber(new ReCaptchaValidationListener($this->reCaptcha));
    }

    /**
     * @inheritDoc
     */
    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $view->vars['type'] = $options['type'];
    }
    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('type', 'invisible')->setAllowedValues('type', ['checkbox', 'invisible']);
    }
}
