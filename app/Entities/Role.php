<?php

namespace App\Entities;

/**
 *@Entity
 *@Table(name="roles")
 */

class Role {

  /**
  *@Id
  *@Column(type="integer")
  *@GeneratedValue()
  */
  protected $id;

  /** 
  *@Column(type="string", nullable=false) 
  */
  protected $roleName;

  /** 
  *@Column(type="boolean", nullable=false) 
  */
  protected $enabled;

  /**
  *@OneToMany(targetEntity="User", mappedBy="role") 
  */
   protected $user;


  public function getId() {
    return $this->id;
  }

  public function setRoleName($roleName) {
    return $this->roleName = $roleName;
  }

  public function getRoleName() {
    return $this->roleName;
  }

  public function setEnabled() {
    return $this->enabled = true;
  }

  public function getEnabled() {
    return $this->enabled;
  }

  public function getUser() {
    return $this->user;
  }

}

?>