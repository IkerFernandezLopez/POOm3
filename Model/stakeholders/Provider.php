<?php
include_once 'Person.php';

class Provider extends Person
{

    protected string $producto, $fecha;

    public function __construct($name, $email, $address, $phone, $id, $age, $producto, $fecha)
    {
        parent::__construct($name, $email, $address, $phone, $id, $age);
        $this->producto = $producto;
        $this->fecha = $fecha;
    }

    public function getProducto(): string
    {
        return $this->producto;
    }

    public function setProducto(string $producto): void
    {
        $this->producto = $producto;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }
    public function getContactData(): string
    {
        return parent::getName() . "<br>" . parent::getAddress() . "<br>" . parent::getPhone() . "<br>" . $this->producto . "<br>" . $this->fecha;
    }
}