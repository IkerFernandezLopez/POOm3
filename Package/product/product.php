<?php
include_once '../exceptions/exceptions.php';
class Product
{
    protected string $name;
    protected int $price;

    public function __construct($name, $price)
    {
        $errorMessage = "";

        if ($name === "Libro" || $name === "Software" || $name === "Curso") {
            $this->name = $name;
        } else {
            $errorMessage .= "Este Producto no está disponible. ";
        }

        if ($price <= 0) {
            $errorMessage .= "Precio inválido. ";
        } else {
            $this->price = $price;
        }

        if ($errorMessage !== "") {
            throw new Exception($errorMessage);
        }
    }

    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }

}