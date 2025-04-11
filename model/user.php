<?php
class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $registrationDate;
    private $role;

    public function __construct($id, $name, $email, $password, $registrationDate, $role) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->registrationDate = $registrationDate;
        $this->role = $role;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRegistrationDate() {
        return $this->registrationDate;
    }

    public function getRole() {
        return $this->role;
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setRegistrationDate($registrationDate) {
        $this->registrationDate = $registrationDate;
    }

    public function setRole($role) {
        $this->role = $role;
    }
}
?>