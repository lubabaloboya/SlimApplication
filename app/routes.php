<?php 

use App\Middleware\AuthMiddleware;

$app->get('/', 'HomeController:index')->setName('home');

$app->get('/users/userslist', 'UsersController:usersList')->setName('users.list');
$app->get('/users/userview', 'UsersController:userview')->setName('users.view');
$app->any('/users/usercreate', 'UsersController:userCreate')->setName('users.create');
$app->post('/users/usersupdate', 'UsersController:usersUpdate')->setName('users.update');
$app->any('/users/usersdelete', 'UsersController:usersDelete')->setName('users.delete');

$app->post('/titles/listtitles', 'TitlesController:listTitles')->setName('list.title');
$app->get('/titles/viewtitle', 'TitlesController:viewTitle')->setName('view.title');
$app->any('/titles/createtitle', 'TitlesController:createTitle')->setName('create.title');
$app->post('/titles/updatetitle', 'TitlesController:updateTitle')->setName('update.title');
$app->any('/titles/deletetitle', 'TitlesController:deleteTitle')->setName('delete.title');

$app->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
$app->post('/auth/signup', 'AuthController:postSignUp');

$app->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
$app->post('/auth/signin', 'AuthController:postSignIn');

$app->group('', function() {

    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');

})->add(new AuthMiddleware($container));
