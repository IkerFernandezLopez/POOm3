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
        $this->instructor = $instructor;
        $this->duration = $duration;
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
}