<?php 

namespace App\Entities;

/**
 *@Entity
 *@Table(name="users")
 */
class User {

    /** 
    *@Id
    *@Column(type="integer") 
    *@GeneratedValue()
    */
    protected $id;

    /**
    *@ManyToOne(targetEntity="Role", inversedBy="user")
    */
    protected $role;

    /**
    *@ManyToOne(targetEntity="Title", inversedBy="user")
    */
    protected $title;

    /** 
    *@Column(type="string", nullable=true) 
    */
    protected $name;

    /** 
    *@Column(type="string", nullable=true) 
    */
    protected $email;

    /** 
    *@Column(type="string", nullable=false) 
    */
    protected $password;

    /** 
    *@Column(type="datetime", nullable=false) 
    */
    protected $created_at;

    /** 
    *@Column(type="datetime", nullable=false) 
    */
    protected $updated_at;
  
    public function getId() {
      return $this->id;
    }

    public function setName($name) {
      return $this->name = $name;
    }

    public function getName() {
      return $this->name;
    }

    public function setRole(Role $role) {
      return $this->role = $role;
    }

    public function getRole() {
      return $this->role;
    }

    public function setTitle(Title $title) {
      return $this->title = $title;
    }

    public function getTitle(){
      return $this->title;
    }

    public function setEmail($email) {
      return $this->email = $email;
    }

    public function getEmail() {
      return $this->email;
    }

    public function setPassword($password) {
      return $this->password = $password;
    }

    public function getPassword() {
      return $this->password;
    }

    public function getCreatedAt() {
      return $this->created_at;
    }

    public function setCreatedAt($created_at) {
      return $this->created_at = $created_at;
    }

    public function getUpdatedAt() {
      return $this->updated_at;
    }

    public function setUpdatedAt($updated_at) {
      return $this->updated_at = $updated_at;
    }

 }