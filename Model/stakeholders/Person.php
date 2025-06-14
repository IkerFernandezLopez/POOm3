<?php
abstract class Person
{
    protected string $name, $email, $address, $phone;
    protected int $id, $age;

    public function __construct($name, $email, $address, $phone, $id, $age)
    {
        if (!is_string($name) || empty(trim($name))) {
            throw new InvalidArgumentException("Name must be a non-empty string.");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format.");
        }
        if (!is_string($address) || empty(trim($address))) {
            throw new InvalidArgumentException("Address must be a non-empty string.");
        }
        if (!is_string($phone) || empty(trim($phone))) {
            throw new InvalidArgumentException("Phone must be a non-empty string.");
        }
        if (!is_int($id) || $id <= 0) {
            (int) $id;
            if ($id % 1 != 0) {
                throw new InvalidArgumentException("ID must be a positive integer.");
            }
        }
        if (!is_int($age) || $age < 0) {
            throw new InvalidArgumentException("Age must be a non-negative integer.");
        }

        $this->name = $name;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
        $this->id = $id;
        $this->age = $age;
    }

    abstract public function getContactData(): string;

    public function getAge(): int
    {
        return $this->age;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


}