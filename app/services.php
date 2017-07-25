<?php 

use App\Services\UserService;
use App\Services\AuthService;

$container['UserService'] = function($container) {
    return new App\Services\UserService($container->get('entityManager'));
};

$container['AuthService'] = function($container) {
    return new App\Services\AuthService($container->get('entityManager'));
};

$container['TitlesService'] = function($container) {
    return new App\Services\TitlesService($container->get('entityManager'));
};