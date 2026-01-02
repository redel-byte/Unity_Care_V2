<?php
require_once __DIR__ . "/User.php";

// firstName, lastName, gender, dateOfBirth, phone, address
class Doctor extends User
{

    private $firstName;
    private $lastName;
    private $gender;
    private $dateOfBirth;
    private $phone;
    private $address;

    public function getRole(): string
    {
        return "patient";
    }
    public function getFullName(): string
    {
        return $this->firstName . " " . $this->lastName;
    }
    function getAge()
    {
        return (new DateTime('now'))->diff(new DateTime($this->dateOfBirth))->y;
    }
}
