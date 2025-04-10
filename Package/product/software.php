<?php
include_once '../exceptions/exceptions.php';
include_once '../Package/product/product.php';

class Software extends Product
{
    protected string $version;
    protected string $license;

    public function __construct($name, $price, $version, $license)
    {
        parent::__construct($name, $price);
        $this->version = $version;
        $this->license = $license;
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
}