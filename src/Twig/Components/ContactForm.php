<?php

namespace App\Twig\Components;

use Symfony\Component\Form\FormView;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'ContactForm', template: 'components/Content/Contact/Form.html.twig')]
final class ContactForm
{
    public FormView $form;
}
