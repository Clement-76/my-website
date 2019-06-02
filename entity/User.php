<?php

namespace App\Entity;

class User extends Entity {

    protected $id;
    protected $pseudo;
    protected $email;
    protected $password;
    protected $role;
    protected $registrationDate;

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = (int)$id;
    }

    /**
     * @param string $pseudo
     */
    public function setPseudo($pseudo) {
        if (is_string($pseudo)) {
            $this->pseudo = $pseudo;
        }
    }

    /**
     * @param string $email
     */
    public function setEmail($email) {
        if (is_string($email)) {
            $this->email = $email;
        }
    }

    /**
     * @param string $password
     */
    public function setPassword($password) {
        if (is_string($password)) {
            $this->password = $password;
        }
    }

    /**
     * @param string $role
     */
    public function setRole($role) {
        if (is_string($role)) {
            $this->role = $role;
        }
    }

    /**
     * @param string $registrationDate
     */
    public function setRegistrationDate($registrationDate) {
        $this->registrationDate = new \DateTime($registrationDate);
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPseudo() {
        return $this->pseudo;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * @return object DateTime
     */
    public function getRegistrationDate() {
        return $this->registrationDate;
    }
}
