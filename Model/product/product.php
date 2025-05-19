<?php
declare(strict_types=1);

include_once '../Exception/BuildException.php';
include_once 'Marketable.php';


abstract class Product implements Marketable
{
    protected string $name;
    protected float $price;
    protected string $details;


    public function __construct(string $name, float $price, string $details)
    {
        $errorMessage = "";

        if (trim($name) === "") {
            $errorMessage .= "Nombre inválido (campo vacío). ";
        } elseif (!preg_match('/^[\p{L}\d\s]+$/u', $name)) {
            $errorMessage .= "Nombre inválido (solo se permiten letras, números y espacios, sin símbolos especiales). ";
        } else {
            $this->name = $name;
        }

        if ($price <= 0.0) {
            $errorMessage .= "Precio inválido (debe ser mayor que 0). ";
        } else {
            $this->price = $price;
        }

        if (trim($details) === "") {
            $errorMessage .= "Detalles inválidos (campo vacío). ";
        } elseif (!preg_match('/^[\p{L}\s]+$/u', $details)) {
            $errorMessage .= "Detalles inválidos (solo se permiten letras y espacios, sin números ni símbolos). ";
        } else {
            $this->details = $details;
        }

        if ($errorMessage !== "") {
            throw new BuildException($errorMessage);
        }
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
