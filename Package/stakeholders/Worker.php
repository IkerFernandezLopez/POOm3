<?php
include_once 'Person.php';
class Worker extends Person
{

    protected string $role;
    protected int $salary;

    public function __construct($name, $email, $address, $phone, $id, $age, $role, $asalary)
    {
        parent::__construct($name, $email, $address, $phone, $id, $age);
        $this->role = $role;
        $this->salary = $asalary;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getSalary(): string
    {
        return $this->salary;
    }

    public function setSalary(int $salary): void
    {
        $this->salary = $salary;
    }

    public function getContactData(): string
    {
        return parent::getName() . "<br>" . parent::getPhone() . "<br>" . $this->role . "<br>" . $this->salary;
    }
}
