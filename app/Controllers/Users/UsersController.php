<?php

namespace App\Controllers\Users;

use App\Entities\User as User;
use App\Controllers\Controller;
use Doctrine\ORM\EntityManager;
use App\Services\UserService;

class UsersController extends Controller {

  public function userCreate($request, $response) {
    
    $users = $this->UserService->create_user($request);
    $results = $this->UserService->messages($users, 'Your request was successful');
    return $results;
    
	}

	public function usersList($request, $response) {

    $users = $this->UserService->list_users();
    //$results = $this->UserService->messages($users, 'Your request was successful');

    return $this->view->render($response, 'users/userslist.twig', array(
      'users' => $users
      ));
	}

  public function userView($request, $response) {

    $user = $this->UserService->view_user($request->getParam('id'));
    $results = $this->UserService->messages($user, 'Your request was successful');
    return $results;
    
	}

  public function usersUpdate($request, $response) {

    $user = $this->UserService->update_user($request);
    $results = $this->UserService->messages($user, 'Your request was successful');
    return $results;

	}

  public function usersDelete($request, $response) {

    $user =  $this->UserService->delete_user($request->getParam('id'));
    $results = $this->UserService->messages($user, 'Your request was successful');
    return $results;
     
	}

}
