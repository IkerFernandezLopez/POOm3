<?php
include_once '../../Exception/BuildException.php';
include_once 'checker.php';
class Address
{
    protected string $pais, $ciudad, $direccion, $codiPostal;

    public function __construct($pais, $ciudad, $direccion, $codiPostal)
    {
        $errorMessage = "";

        if (checker::isEmpty($pais) == true) {
            $errorMessage .= "pais es invalido ";
        } else {
            $this->pais = $pais;
        }

        if (checker::isEmpty($ciudad) == true) {
            $errorMessage .= "ciudad es invalido ";
        } else {
            $this->ciudad = $ciudad;
        }

        if (checker::isEmpty($direccion) == true) {
            $errorMessage .= "la direccion es invalida ";
        } else {
            $this->direccion = $direccion;
        }

        if (checker::isEmpty($codiPostal) == true) {
            $errorMessage .= "el codiPostal es invalido ";
        } else {
            $this->codiPostal = $codiPostal;
        }

        if ($errorMessage !== "") {
            throw new BuildException($errorMessage);
        }
    }

    public function getPais(): string
    {
        return $this->pais;
    }

    public function setPais($pais): void
    {
        $this->pais = $pais;
    }

    public function getCiudad(): string
    {
        return $this->ciudad;
    }

    public function setCiudad($ciudad): void
    {
        $this->ciudad = $ciudad;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    public function getCodigoPostal(): string
    {
        return $this->codiPostal;
    }


    public function setCodigoPostal($codiPostal): void
    {
        $this->codiPostal = $codiPostal;
    }
}