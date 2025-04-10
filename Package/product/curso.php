<?php
include_once '../exceptions/exceptions.php';
include_once '../Package/product/product.php';

class Curso extends Product
{
    protected string $instructor;
    protected int $duration;

    public function __construct($name, $price, $instructor, $duration)
    {
        parent::__construct($name, $price);
        $errorMessage = "";
        if ($instructor === "") {
            $errorMessage .= "Instructor inválido. ";
        } else {
            $this->instructor = $instructor;
        }
        if ($duration <= 0) {
            $errorMessage .= "Duración inválida. ";
        } else {
            $this->duration = $duration;
        }
    }
    public function getInstructor()
    {
        return $this->instructor;
    }
    public function getDuration()
    {
        return $this->duration;
    }
    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;
    }
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    // La función getDescription() devuelve una descripción del curso, incluyendo su nombre, precio, instructor y duración.
    public function getDescription()
    {
        return "Curso: " . $this->name . ", Precio: " . $this->price . ", Instructor: " . $this->instructor . ", Duración: " . $this->duration;
    }
}