<?php

namespace App\Entities;

/**
 * @Entity
 * @Table(name="roles")
 */

class Role {

  /**
  * @id
  * @Column(type="integer")
  * @GeneratedValue
  */
  protected $id;

  /** 
  * @Column(type="string", nullable=false, ) 
  */
  protected $roleName;

   /** 
  * @Column(type="boolean", nullable=false) 
  */
  protected $enabled;

  /**
   * @OneToMany(targetEntity="User", mappedBy="role")
   */
   protected $user;


  function getId() {
    return $this->id;
  }

  function setRoleName($roleName) {
    return $this->roleName = $roleName;
  }

  function getRoleName() {
    return $this->roleName;
  }

  function setEnabled() {
    return $this->enabled = true;
  }

  function getEnabled() {
    return $this->enabled;
  }

  function getUser() {
    return $this->user;
  }

}

?>