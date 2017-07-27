<?php 

use App\Controllers\HomeController;
use App\Controllers\Auth\AuthController;
use App\Controllers\Users\UsersController;
use App\Controllers\AboutController;
use App\Controllers\Auth\PAsswordController;
use App\Controllers\Titles\TitlesController;

$container['HomeController'] = function($container) {
	return new App\Controllers\Home\HomeController($container);
};

$container['AuthController'] = function($container) {
    return new App\Controllers\Auth\AuthController($container);
};

$container['UsersController'] = function($container) {
    return new App\Controllers\Users\UsersController($container);
};

$container['AboutController'] = function($container) {
    return new App\Controllers\AboutController($container);
};

$container['PasswordController'] = function($container) {
    return new App\Controllers\Auth\PAsswordController($container);
};

$container['TitlesController'] = function($container) {
    return new App\Controllers\Titles\TitlesController($container);
};