<?php

namespace App\Presentation;

class Presentation
{
    public function build(PresentationInterface $presentation, array $context = [])
    {
        return $presentation->render($context);
    }
}