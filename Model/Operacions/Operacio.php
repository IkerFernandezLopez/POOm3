<?php
include_once 'checker.php';

abstract class Operacio
{
    protected int $codiOperacio, $codigoEmpleado;
    protected string $dataInici;
    protected float $price;
    public function __construct($codiOperacio, $codigoEmpleado, $dataInici, $price)
    {
        $this->codiOperacio = $codiOperacio;
        $this->codigoEmpleado = $codigoEmpleado;
        $this->dataInici = $dataInici;
        $this->price = $price;
    }

    public function getCodi(): int
    {
        return $this->codiOperacio;
    }

    public function setCodi(int $codiOperacio): void
    {
        $this->codiOperacio = $codiOperacio;
    }

    public function getCodiEmpleado(): int
    {
        return $this->codiOperacio;
    }

    public function setCodiEmpleado(int $codiOperacio): void
    {
        $this->codiOperacio = $codiOperacio;
    }

    public function getDataInici(): string
    {
        return $this->dataInici;
    }

    public function setDataInici(string $dataInici): void
    {
        $this->dataInici = $dataInici;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }


    // Metodo abstracto 
    public abstract function getType();
}