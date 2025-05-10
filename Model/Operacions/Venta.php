<?php
include_once 'Operacio.php';
include_once 'checker.php';
include_once '../../Exception/BuildException.php';
include_once 'facturable.php';

class Venta extends Operacio implements Facturable
{
    protected string $codiClient, $dataEntrega, $type;
    protected int $sobrecargo;
    public function __construct($codiClient, $dataEntrega, $sobrecargo, $type, $codiOperacio, $codigoEmpleado, $dataInici, $price)
    {
        parent::__construct($codiOperacio, $codigoEmpleado, $dataInici, $price);

        $messageError = "";

        if (checker::isEmpty($codiClient) == true) {
            $messageError .= "Codi Client es invalido";
        } else {
            $this->codiClient = $codiClient;
        }

        if (checker::isEmpty($dataEntrega) == true) {
            $messageError .= "dataEntrega es invalido";
        } else {
            $this->dataEntrega = $dataEntrega;
        }

        if (checker::isNull($sobrecargo) == true) {
            $messageError .= "sobrecargo es invalido";
        } else {
            $this->sobrecargo = $sobrecargo;
        }

        if (checker::isEmpty($type) == true) {
            $messageError .= "type es invalido";
        } else {
            $this->type = $type;
        }
        if ($messageError !== "") {
            throw new Exception($messageError);
        }
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getCodiClient(): string
    {
        return $this->codiClient;
    }
    public function setCodiClient($codiClient): void
    {
        $this->codiClient = $codiClient;
    }
    public function getDataEntrega(): string
    {
        return $this->dataEntrega;
    }

    public function setDataEntrega($dataEntrega): void
    {
        $this->dataEntrega = $dataEntrega;
    }

    public function getSobrecargo(): string
    {
        return $this->codiClient;
    }

    public function setSobrecargo($sobrecargo): void
    {
        $this->sobrecargo = $sobrecargo;
    }


    //--------------------------------------------------------------





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

    //--------------------------------


    public function getTotalPrice()
    {
        return $this->price + $this->sobrecargo;
    }

    public function getAllDates()
    {
        return "Fecha Entrega - " . $this->dataEntrega . " - Data Inicio - " . $this->dataInici;
    }
}