<?php

declare(strict_types=1);
include '../Exception/ServiceException.php';

abstract class MySQLAdapter
{

    protected mysqli $connection;
    protected bool $connected = false;


    //Aprofitem el constructor per establir la connexió per defecte a la nostra BD
    public function __construct()
    {
        $user = "Iker";
        $password = "a(eC2C!7uVi*8Oi4";
        $db = "softlearning";
        $port = 3306;


        try {
            $this->connection = new mysqli("host.docker.internal", $user, $password, $db, $port);
            $this->connected = true;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("DB Connection Failure: " . $ex->getMessage());
        }
    }

    public function __destruct()
    {
        $this->closeConnection();
    }

    public function isConnected(): bool
    {
        return $this->connected;
    }

    //sempre podrem reconectar-nos a altres BD's aprofitant el mateix objecte
    public function connect(string $host, string $user, string $password, string $db, int $port)
    {
        if ($this->connected == true) {
            $this->closeConnection();
        }
        try {
            $this->connection = new mysqli($host, $user, $password, $db, $port);
            $this->connected = true;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("DB Connection Failure: " . $ex->getMessage());
        }
    }

    public function closeConnection()
    {
        if ($this->connected == true) {
            $this->connection->close();
            $this->connected = false;
        }
    }

    protected function readQuery(string $query): array
    {
        $dataset = [];
        $result = $this->connection->query($query);
        if ($result != false) {
            while ($row = $result->fetch_assoc()) {
                $dataset[] = $row;
            }
        }
        return $dataset;
    }

    protected function writeQuery(string $query): bool
    {
        $result = $this->connection->query($query);
        return $result;
    }

}


