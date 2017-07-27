<?php

namespace App\Services;

use App\Entities\User ;
use App\Entities\Role;
use App\Entities\Title;
use Doctrine\ORM\EntityManager;

class UserService {

  protected $_em;
  protected $_date;

  public function __construct(EntityManager $em){
      $this->_em = $em;
      $this->_date = new \DateTime();
  }

  public function create_user ($request) {

    $user = new User;
    $user->setName($request->getParam('name'));
    $user->setEmail($request->getParam('email'));
    $user->setPassword(password_hash($request->getParam('password'), PASSWORD_DEFAULT));
    $user->setCreatedAt($this->_date);
    $user->setUpdatedAt($this->_date);

    $role = $this->_em->find('App\Entities\Role', $request->getParam('role_id'));
    $user->setRole($role);

    $title = $this->_em->find('App\Entities\Title', $request->getParam('title_id'));
    $user->setTitle($title);

    if (!is_null($request->getParam('email')) && !is_null($request->getParam('name')) ){
      $this->_em->persist($user);
      $this->_em->flush();
      return $user;
    }
    return false;

  }

  public function list_users() {

    $qb = $this->_em->createQueryBuilder();
      $results = $qb->select(array('u','r','t'))
      ->from('App\Entities\User', 'u')
      ->innerJoin('u.role', 'r')
      ->innerJoin('u.title', 't')
      ->getQuery()
      ->getArrayResult();
    return $results;
  }

  public function view_user($id) {

    $qb = $this->_em->createQueryBuilder();
      $results = $qb->select('u', 'r','t')
        ->from('App\Entities\User', 'u')
        ->innerJoin('u.role', 'r')
        ->innerJoin('u.title', 't')
        ->where('u.id'. $id)
        ->getQuery()
        ->getArrayResult();
      
    return $results;
  }

  public function update_user($request) {

    $results = $this->_em->find('App\Entities\User', $request->getParam('id'));

    if (!empty($results)) {
      $results->setName($request->getParam('name'));
      $results->setEmail($request->getParam('email'));
      $results->setPassword(password_hash($request->getParam('password'), PASSWORD_DEFAULT));
      $results->setUpdatedAt($this->_date);
  
      if (!empty($request->getParam('role'))) {
        $role = $this->_em->find('App\Entities\Role', $request->getParam('role'));
        $results->setRole($role);
      }

      if (!empty($request->getParam('title'))) {
        $title = $this->_em->find('App\Entities\Title', $request->getParam('title'));
        $results->setTitle($title);
      }

      $this->_em->persist($results);
      $this->_em->flush();
      return $results;
    }
    return false;
  }

  public function delete_user($id) {
    $results = $this->_em
      ->find('App\Entities\User', $id);

    if ($results) {
      $this->_em->remove($results);
      $this->_em->flush();

      return $results;
    }
    return false;
  }

  public function messages ($results, $msg) {

    $array = array( 'Status' => false, 'Message' => 'Sorry your request was unsuccessful', 'Results' => Null );
    
    if (!empty($results) && !is_null($results) ) {
      $array['Status']  = true;
      $array['Message'] = $msg;
      $array['Results'] = $results;
    }

    return json_encode($array);
  }

}