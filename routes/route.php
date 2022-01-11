<?php

use App\Controller\ArticleController;

$router->get('/',[ArticleController::class,'index']);