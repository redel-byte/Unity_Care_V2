<?php
require_once __DIR__ . "../Core/Validator.php";
abstract class User
{
    //propreites;
    protected $id;
    protected $email;
    protected $username;
    protected $passwordHash;

    public function __construct($id, $email, $username)
    {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (Validator::validateEmail($email)) {
            $this->email = $email;
            return $this;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        if (Validator::isstring($username)) {
            $this->username = $username;
            return $this;
        }
    }
    abstract public function getRole(): string;
    public function verifyPassword($password): bool
    {
        return password_verify($password, $this->passwordHash);
    }
}
