<?php
include_once 'Person.php';

class Client extends Person
{
    protected DateTime $joined_at;
    protected int|float $CantCompras;

    public function __construct($name, $email, $address, $phone, $id, $age, $joined_at, $CantCompras)
    {
        parent::__construct($name, $email, $address, $phone, $id, $age);

        if (checker::checkDate($joined_at) !== 0) {
            throw new DataException("Fecha de ingreso inválida");
        } else {
            $this->joined_at = new DateTime($joined_at);
        }
        $this->CantCompras = $CantCompras;
    }

    public function getJoinedAt(): DateTime
    {
        return $this->joined_at;
    }

    public function setJoinedAt(DateTime $joined_at): void
    {
        $this->joined_at = $joined_at;
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
        return "Nombre: " . parent::getName() . "<br>Direccion: " . parent::getAddress() . "<br>Num Tel. " . parent::getPhone() . "<br>Tipo Cliente: " . $this->joined_at . "<br>Cant. Compra: " . $this->CantCompras;
    }
}