<?php
include_once 'Operacio.php';
include_once 'checker.php';
include_once '../../Exception/BuildException.php';
include_once 'facturable.php';
class Compra extends Operacio implements Facturable
{
    protected string $codiProveidor, $dataRecepcion, $type;
    protected int $impuestos;

    public function __construct($codiOperacio, $codigoEmpleado, $dataInici, $price, $codiProveidor, $dataRecepcion, $impuestos, $type, )
    {
        parent::__construct($codiOperacio, $codigoEmpleado, $dataInici, $price, $type);

        $messageError = "";

        if (checker::isEmpty($codiProveidor) == true) {
            $messageError .= "El codigo de proovedor no es valido";
        } else {
            $this->codiProveidor = $codiProveidor;
        }
        if (checker::isEmpty($dataRecepcion) == true) {
            $messageError .= "La fecha de recepcion no es valida";
        } else {
            $this->dataRecepcion = $dataRecepcion;
        }
        if (checker::isNull($impuestos) == true) {
            $messageError .= "La tasa de impuestos no es valida";
        } else {
            $this->impuestos = $impuestos;
        }
        if (checker::isEmpty($type) == true) {
            $messageError .= "El tipo no es valido";
        } else {
            $this->type = $type;
        }

        if ($messageError !== "") {
            throw new Exception($messageError);
        }
    }
    public function getType()
    {
        return $this->type;
    }

    public function getCodiProovedor()
    {
        return $this->codiProveidor;
    }
    public function getDataRecepcion()
    {
        return $this->dataRecepcion;
    }
    public function getImpuestos()
    {
        return $this->impuestos;
    }



    public function getCodi(): int
    {
        return $this->codiOperacio;
    }

    public function setCodi(int $codiOperacio): void
    {
        $this->codiOperacio = $codiOperacio;
    }

    public function getCodiEmpleado(): int
    {
        return $this->codiOperacio;
    }

    public function setCodiEmpleado(int $codiOperacio): void
    {
        $this->codiOperacio = $codiOperacio;
    }

    public function getDataInici(): string
    {
        return $this->dataInici;
    }

    public function setDataInici(string $dataInici): void
    {
        $this->dataInici = $dataInici;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }


    //-----------------------------


    public function getTotalPrice()
    {
        return $this->getPrice() + ($this->getPrice() * $this->impuestos / 100);
    }

    public function getAllDates()
    {
        return "Fecha Entrega - " . $this->dataRecepcion . " - Data Inicio - " . $this->dataInici;
    }
}