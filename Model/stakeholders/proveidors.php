<?php

class proveidor extends Person
{
    protected string $tipo, $fecha;

    public function __construct($name, $email, $address, $phone, $id, $age, $tipo, $fecha)
    {
        parent::__construct($name, $email, $address, $phone, $id, $age);
        $this->tipo = $tipo;
        $this->fecha = $fecha;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
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
        return "Nombre: " . parent::getName() . "<br>Direccion: " . parent::getAddress() . "<br>Num Tel. " . parent::getPhone() . "<br>Tipo Proveedor: " . $this->tipo . "<br>Fecha de contrato: " . $this->fecha;
    }
}