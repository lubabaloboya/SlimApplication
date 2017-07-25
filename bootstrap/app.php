<?php 

session_start();

use Respect\Validation\Validator as v;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
	'settings' => [
		'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host'   => 'localhost',
            'database' => 'slim_application',
            'username' => 'root',
            'password' => '',
            'charset'  => 'utf8',
            'collation'=> 'utf8_unicode_ci',
            'prefix' => '',
        ]
	]

]);

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();


use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


$container["db"] = function ($container) use ($capsule) {
    return $capsule;
};

$container["entityManager"] = function ($container) {

    $paths = array("App/Entities/");
    $isDevMode = false;

    // the connection configuration
    $dbParams = array(
        'driver'   => 'pdo_mysql',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'slim_application',
    );

    $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
    $entityManager = EntityManager::create($dbParams, $config);
    return $entityManager;
};

$container['auth'] = function($container){
    return new \App\Auth\Auth;
};

$container['view'] = function ($container) {
	$view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
		'cache' => false
	]);

	$view->addExtension(new \Slim\Views\TwigExtension(
		$container->router,
		$container->request->getUri()
	));

	$view->getEnvironment()->addGlobal('auth', [
	    'check' => $container->auth->check(),
        'user'  => $container->auth->user()
    ]);

    $view->getEnvironment()->addGlobal('flash', $container->flash);

	return $view;
};

$container['validator'] = function($container) {
    return new \App\Validation\Validator;
};

require __DIR__ . '/../app/controller.php';

require __DIR__ . '/../app/services.php';

$container['csrf'] = function($container){
    return new \Slim\Csrf\Guard;
};

$container['flash'] = function($container){
    return new \Slim\Flash\Messages;
};


$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));

//$app->add($container->csrf);

v::with('App\\Validation\\Rules\\');

require __DIR__ . '/../app/routes.php';


