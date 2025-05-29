<?php
declare(strict_types=1);

include_once '../Exception/BuildException.php';
include_once 'Marketable.php';


abstract class Product implements Marketable
{
    protected $name;
    protected float $price;
    protected string $details;

    public function __construct($name, $price, $details)
    {

        if (!is_string($name)) {
            throw new BuildException("Nombre inválido (debe ser una cadena de texto).");
        }
        if (trim($name) === "") {
            throw new BuildException("Nombre inválido (campo vacío).");
        }

        if (!preg_match('/^[\p{L}\d\s]+$/u', $name)) {
            throw new BuildException("Nombre inválido (solo se permiten letras, números y espacios, sin símbolos especiales).");
        }

        $this->name = $name;


        if (!is_numeric($price) || !is_float($price)) {
            throw new BuildException("Precio inválido (debe ser un número válido).");
        }

        if ($price <= 0.0) {
            throw new BuildException("Precio inválido (debe ser mayor que 0).");
        }

        $this->price = $price;

        if (trim($details) === "") {
            throw new BuildException("Detalles inválidos (campo vacío).");
        }

        if (!preg_match('/^[\p{L}\s]+$/u', $details)) {
            throw new BuildException("Detalles inválidos (solo se permiten letras y espacios, sin números ni símbolos).");
        }

        $this->details = $details;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getPrice(): float
    {
        return $this->price;
    }


    public function getDetails(): string
    {
        return $this->details;
    }


    public function setName(string $name): void
    {
        $this->name = $name;
    }


    public function setPrice(float $price): void
    {
        $this->price = $price;
    }


    public function setDetails(string $details): void
    {
        $this->details = $details;
    }


    public abstract function getDescription(): string;
}
