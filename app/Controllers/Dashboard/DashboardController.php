<?php


namespace App\Controllers\Dashboard;

use App\Models\User;
use App\Controllers\Controller;
use Slim\Views\Twig as View;

class DashboardController extends Controller {


    public function index($request, $response) {

        //$this->flash->addMessage('error', 'Test Flash Message');
		return $this->view->render($response, 'dashboard/dashboard.twig');
	}

}
