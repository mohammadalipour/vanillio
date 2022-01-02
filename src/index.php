<?php

/**
 * Autoload Classes
 */
require '../vendor/autoload.php';

/**
 * Require routes file
 */
require 'routes.php';

/**
 * Require configuration file
 */
require 'config.php';

/**
 * Handle routes from Route helper class
 */
use App\Helpers\Route;

Route::handle($_SERVER['PHP_SELF']);