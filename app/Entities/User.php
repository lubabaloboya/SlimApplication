<?php 

namespace App\Entities;

/**
 * @Entity
 * @Table(name="users")
 */
class User {

  /** 
    * @Id
    * @Column(type="integer") 
    * @GeneratedValue()
    */
    protected $id;

    /**
    * @ManyToOne(targetEntity="App\Entities\Role", inversedBy="user", cascade={"remove"})
    * @JoinColumn(name="role_id", referencedColumnName="id", onDelete="Cascade")
    */
    protected $role;

    /**
    * @ManyToOne(targetEntity="App\Entities\Title", inversedBy="user", cascade={"remove"})
    * @JoinColumn(name="title_id", referencedColumnName="id", onDelete="Cascade")
    */
    protected $title;

    /** 
    * @Column(type="string", nullable=true) 
    */
    protected $name;

    /** 
    * @Column(type="string", nullable=true) 
    */
    protected $email;

     /** 
    * @Column(type="string", nullable=false) 
    */
    protected $password;

    /** 
    * @Column(type="datetime", nullable=false) 
    */
    protected $created_at;

    /** 
    * @Column(type="datetime", nullable=false) 
    */
    protected $updated_at;
  
    function getId() {
      return $this->id;
    }

    function setName($name) {
      return $this->name = $name;
    }

    function getName() {
      return $this->name;
    }

    function setRole(Role $role) {
      return $this->role = $role;
    }

    function getRole() {
      return $this->role;
    }

    public function setTitleName(Title $title) {
      return $this->title = $title;
    }

    public function getTitleName(){
      return $this->title;
    }

    function setEmail($email) {
      return $this->email = $email;
    }

    function getEmail() {
      return $this->email;
    }

    function setPassword($password) {
      return $this->password = $password;
    }

    function getPassword() {
      return $this->password;
    }

    function getCreatedAt() {
      return $this->created_at;
    }

    function setCreatedAt($created_at) {
      return $this->created_at = $created_at;
    }

    function getUpdatedAt() {
      return $this->updated_at;
    }

    function setUpdatedAt($updated_at) {
      return $this->updated_at = $updated_at;
    }

 }