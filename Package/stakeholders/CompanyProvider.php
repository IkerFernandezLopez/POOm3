<?php


class CompanyProvider extends Provider
{
    protected string $companyType;

    public function __construct($name, $email, $address, $phone, $id, $age, $producto, $fecha, $companyType)
    {
        //! funciones importadas del padre
        parent::__construct($name, $email, $address, $phone, $id, $age, $producto, $fecha);

        //! Funciones del hijo
        $this->companyType = $companyType;


        $errorMessage = "";
        if ($this->companyType === "") {
            $errorMessage .= "El tipo de empresa no es correcto, por favor verifique el tipo de empresa <br>";
            print $errorMessage;
        }

    }
    public function getContactData(): string
    {
        return "Company Type: " . $this->companyType . "<br>" .
            "Producto: " . parent::getProducto() . "<br>" .
            "Fecha: " . parent::getFecha() . "<br>" .
            "Name: " . parent::getName() . "<br>" .
            "Email: " . parent::getEmail() . "<br>" .
            "Address: " . parent::getAddress() . "<br>" .
            "Phone: " . parent::getPhone() . "<br>" .
            "ID: " . parent::getId() . "<br>" .
            "Age: " . parent::getAge();
    }
}