<?php

namespace App\Services;

use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Respect\Validation\Validator as v;

class AuthService {

  protected $_em;
  protected $_date;

  public function __construct(EntityManager $em){
    $this->_em = $em;
    $this->_date = new \DateTime();
  }

  public function sign_up ($request) {

    $user = new User;
    $user->setName($request->getParam('name'));
    $user->setEmail($request->getParam('email'));
    $user->setPassword(password_hash($request->getParam('password'), PASSWORD_DEFAULT));
    $user->setCreatedAt($this->_date);
    $user->setUpdatedAt($this->_date);

    if (!is_null($request->getParam('email')) && !is_null($request->getParam('name')) )  {
      $this->_em->persist($user);
      $this->_em->flush();
      return $user;
    }
    return false;
  }

  public function attempt($email, $password) {
       
    $email_old = $this->_em->find('App\Entities\User', $email);
    $password_old = $this->_em->find('App\Entities\User', $password);

    if(!$email_old && !$password_old) {
      return false;
    }
         
    if(password_verify($password, $password_old)){
      $_SESSION[user] = $user->id;
      return true;
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