<?php
declare(strict_types=1);
include_once '../exceptions/exceptions.php';
include_once '../Package/product/Marketable.php';
// La clase Product implementa la interfaz Marketable, lo que significa que debe implementar los métodos definidos en la interfaz.
// al ser una clase abstracta, esta no puede ser iniciada como sus hijos, esta actua como una interfaz o plantilla para los hijos.



abstract class Product implements Marketable
{
    protected string $name, $details;
    protected int $price;

    public function __construct($name, $price, $details)
    {

        // Validar el nombre y el precio del producto y devuelve un mensaje de error en caso de encontrar.
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

        if ($details === "") {
            $errorMessage .= "Detalles inválidos. ";
        } else {
            $this->details = $details;
        }

        // Si hay un mensaje de error, lanzamos una excepción que hace que el conhstructor no se ejecute, asi que no se crea el objeto.
        if ($errorMessage !== "") {
            throw new Exception($errorMessage);
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

    public function setName($name)
    {
        $this->name = $name;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function setDetails($details)
    {
        $this->details = $details;
    }

    // Funcion abstracta para obtener la descripción del producto y que se puede editar en cada subclase, como si fuera una interfaz pero desde el padre
    public abstract function getDescription();
}