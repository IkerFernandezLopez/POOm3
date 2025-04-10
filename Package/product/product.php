<?php
include_once '../exceptions/exceptions.php';
// al ser una clase abstracta, esta no puede ser iniciada como sus hijos, esta actua como una interfaz o plantilla para los hijos.
abstract class Product
{
    protected string $name;
    protected int $price;

    public function __construct($name, $price)
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

        // Si hay un mensaje de error, lanzamos una excepción que hace que el conhstructor no se ejecute, asi que no se crea el objeto.
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

    // Funcion abstracta para obtener la descripción del producto y que se puede editar en cada subclase, como si fuera una interfaz pero desde el padre
    public abstract function getDescription();
}