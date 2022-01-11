<?php

namespace App\Exception;

class RouteNotFoundException extends \Exception
{
    protected $message = 'route dose not exist';
}