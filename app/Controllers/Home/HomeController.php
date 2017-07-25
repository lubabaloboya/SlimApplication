<?php


namespace App\Controllers\Home;

use App\Models\User;
use App\Controllers\Controller;
use Slim\Views\Twig as View;

class HomeController extends Controller {


    public function index($request, $response) {

        // $query = $this->entityManager->createQuery('SELECT u.id FROM App\Models\User u');
        // $ids = $query->getResult(); // array of CmsUser ids
        
        // var_dump($ids);
        // die();

        //$this->flash->addMessage('error', 'Test Flash Message');
		return $this->view->render($response, 'home.twig');
	}

}
