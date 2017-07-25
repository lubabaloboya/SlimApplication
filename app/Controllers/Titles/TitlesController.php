<?php

namespace App\Controllers\Titles;

use App\Controllers\Controller;
use Doctrine\ORM\EntityManager;
use App\Services\TitlesService;

class TitlesController extends Controller {

  public function createTitle($request, $response) {

    $title = $this->TitlesService->create_title($request);
    $results = $this->TitlesService->messages($title, 'Your request was successful');
    return $results;
    
	}

	public function listTitles($request, $response) {

    $titles = $this->TitlesService->list_titles();
    $results = $this->TitlesService->messages($titles, 'Your request was successful');
    return $results;
    
	}

  public function viewTitle($request, $response) {

    $title = $this->TitlesService->view_title($request->getParam('id'));
    $results = $this->TitlesService->messages($title, 'Your request was successful');
    return $results;
    
	}

  public function updateTitle($request, $response) {

    $title = $this->TitlesService->update_title($request->getParam('id'), $request);
    $results = $this->TitlesService->messages($title, 'Your request was successful');
    return $results;

	}

  public function deleteTitle($request, $response) {

    $title =  $this->TitlesService->delete_user($request->getParam('id'));
    $results = $this->TitlesService->messages($title, 'Your request was successful');
    return $results;
     
	}

}
