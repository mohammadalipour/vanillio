<?php

namespace App\Presentation;

interface PresentationInterface
{
    public function render(array $context = []);
}