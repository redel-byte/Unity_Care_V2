<?php
require_once __DIR__ . "/User.php";


class Doctor extends User
{

    private $firstName;
    private $lastName;
    private $specialization;
    private $phone;
    private $departmentId;

    public function getRole(): string
    {
        return "Doctor";
    }
    public function getFullName(): string
    {
        return $this->firstName . " " . $this->lastName;
    }
}
