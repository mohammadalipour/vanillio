<?php

use App\Presentation\Presentation;
use App\Presentation\Web\Twig;

$router->get('/',function (){
    $presentation = new Presentation();
    $presentation->build(new Twig('index.html'),['name'=>'Mohammad']);
});