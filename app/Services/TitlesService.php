<?php

namespace App\Services;

use App\Entities\Title;
use Doctrine\ORM\EntityManager;

class TitlesService {

  protected $_em;

  public function __construct(EntityManager $em){
    $this->_em = $em;
  }

  public function create_title ($request) {

    $title = new Title;
    $title->setTitle($request->getParam('titleName'));

    if (!is_null($request->getParam('titleName')) ){
      $this->_em->persist($title);
      $this->_em->flush();
      return $title;
    }
    return false;

  }

  public function list_titles() {

    $qb = $this->_em->createQueryBuilder();
    $results = $qb->select('u')
      ->from('App\Entities\Title', 'u')
      ->getQuery()
      ->getArrayResult();
    return $results;
  }

  public function view_title($id) {

    $qb = $this->_em->createQueryBuilder();
      $results = $qb->select('u')
        ->from('App\Entities\Title', 'u')
        ->where('u.id='. $id)
        ->getQuery()
        ->getArrayResult();
      
    return $results;
  }

  public function update_title($id, $request) {
    
    $results = $this->_em->find('App\Entities\Title', $id);
    if ($results !== null) {
      $results->setTitle($request->getParam('titleName'));

      $this->_em->persist($results);
      $this->_em->flush();
      return $results;
    }
    return false;
  }

  public function delete_title($id) {
    $results = $this->_em
      ->find('App\Entities\Title', $id);
   
    if ($results) {
      $this->_em->remove($results);
      $this->_em->flush();

      return $results;
    }
    return false;
  }

  public function messages ($results, $msg) {

    $array = array( 'Status' => false, 'Message' => 'Sorry your request was unseccesful', 'Results' => Null );
    
    if (!empty($results) && !is_null($results) ) {
      $array['Status']  = true;
      $array['Message'] = $msg;
      $array['Results'] = $results;
    }

    return json_encode($array);
  }

}