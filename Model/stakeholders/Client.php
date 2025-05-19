<?php
declare(strict_types=1);

include_once 'Person.php';
include_once '../Exception/DataException.php';

class Client extends Person
{
    protected DateTime $joined_at;
    protected int|float $CantCompras;

    public function __construct($id, $name, $email, $address, $phone, $age, $joined_at, $CantCompras)
    {
        parent::__construct($name, $email, $address, $phone, $id, $age);

        $this->joined_at = $this->validateJoinedAt($joined_at);

        $this->CantCompras = $this->validateCantCompras($CantCompras);
    }

    private function validateJoinedAt($joined_at): DateTime
    {
        try {
            if ($joined_at instanceof DateTime) {
                return $joined_at;
            } elseif (is_string($joined_at)) {
                Checker::checkDate($joined_at);
                $date = DateTime::createFromFormat('d-m-Y H:i:s', $joined_at);
                if ($date === false) {
                    throw new Exception("Fecha de ingreso inválida: formato incorrecto");
                }
                return $date;
            } else {
                throw new Exception("Fecha de ingreso inválida: tipo no soportado");
            }
        } catch (Exception $e) {
            error_log("Error en fecha joined_at: " . $e->getMessage());
        }
    }

    private function validateCantCompras($value): int|float
    {
        if (!is_numeric($value)) {
            error_log("CantCompras no es numérico, usando 0 como fallback");
            return 0;
        }
        return $value;
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
        return (string) $this->CantCompras;
    }

    public function setCantCompras($CantCompras): void
    {
        $this->CantCompras = $this->validateCantCompras($CantCompras);
    }

    public function getContactData(): string
    {
        return "Nombre: " . parent::getName() . "<br>Direccion: " . parent::getAddress() .
            "<br>Num Tel. " . parent::getPhone() . "<br>Fecha Ingreso: " .
            $this->joined_at->format('d-m-Y') . "<br>Cant. Compra: " . $this->CantCompras;
    }
}