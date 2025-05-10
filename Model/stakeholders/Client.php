<?php
include_once 'Person.php';

class Client extends Person
{
    protected string $tipo;
    protected int|float $CantCompras;

    public function __construct($name, $email, $address, $phone, $id, $age, $tipo, $CantCompras)
    {
        parent::__construct($name, $email, $address, $phone, $id, $age);
        $this->tipo = $tipo;
        $this->CantCompras = $CantCompras;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getCantCompras(): string
    {
        return $this->CantCompras;
    }

    public function setCantCompras($CantCompras): void
    {
        $this->CantCompras = $CantCompras;
    }

    public function getContactData(): string
    {
        return "Nombre: " . parent::getName() . "<br>Direccion: " . parent::getAddress() . "<br>Num Tel. " . parent::getPhone() . "<br>Tipo Cliente: " . $this->tipo . "<br>Cant. Compra: " . $this->CantCompras;
    }
}