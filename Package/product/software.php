<?php
declare(strict_types=1);
include_once '../exceptions/exceptions.php';
include_once '../Package/product/product.php';


class Software extends Product
{
    protected string $version;
    protected string $license;

    public function __construct($name, $price, $version, $license, $details)
    {
        parent::__construct($name, $price, $details);
        $errorMessage = "";
        if ($version === "") {
            $errorMessage .= "Versión inválida. ";
        } else {
            $this->version = $version;
        }
        if ($license === "") {
            $errorMessage .= "Licencia inválida. ";
        } else {
            $this->license = $license;
        }
    }
    public function getVersion()
    {
        return $this->version;
    }
    public function getLicense()
    {
        return $this->license;
    }
    public function setVersion($version)
    {
        $this->version = $version;
    }
    public function setLicense($license)
    {
        $this->license = $license;
    }

    public function getDescription()
    {
        return "Software: " . $this->name . ", Precio: " . $this->price . ", Versión: " . $this->version . ", Licencia: " . $this->license;
    }
}