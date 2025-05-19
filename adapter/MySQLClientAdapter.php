<?php

class MysqlClientAdapter extends MySQLAdapter
{
    public function getClientById(int $id): Client
    {
        $data = $this->readQuery("SELECT * FROM clients WHERE id = $id;");
        if (count($data) > 0) {
            $row = $data[0];
            return new Client(
                $row['id'],
                $row['name'],
                $row['email'],
                $row['address'],
                $row['phone'],
                intval($row['age']),
                new DateTime($row['joined_at']),
                intval($row['CantCompras']),
            );

        } else {
            throw new ServiceException("No se encontró el cliente con id = $id");
        }
    }

    public function deleteClient(int $id): bool
    {
        try {
            return $this->writeQuery("DELETE FROM clients WHERE id = $id;");
        } catch (Exception $e) {
            throw new ServiceException("Error al eliminar el cliente: " . $e->getMessage());
        }
    }

    public function addClient(Client $u): bool
    {
        try {
            // Si last_purchase es obligatorio, debes proveer un valor o eliminar la columna del INSERT
            return $this->writeQuery("INSERT INTO clients (name, email, address, phone, age, joined_at, CantCompras) VALUES (
                '" . $u->getName() . "',
                '" . $u->getEmail() . "',
                '" . $u->getAddress() . "',
                '" . $u->getPhone() . "',
                " . $u->getAge() . ",
                '" . $u->getJoinedAt()->format('Y-m-d H:i:s') . "',
                " . $u->getCantCompras() . "
            );");
        } catch (Exception $e) {
            throw new ServiceException("Error al agregar el cliente: " . $e->getMessage());
        }
    }

    public function updateClient(Client $u, int $id): bool
    {
        try {
            return $this->writeQuery("UPDATE clients SET 
                name = '" . $u->getName() . "',
                email = '" . $u->getEmail() . "',
                address = '" . $u->getAddress() . "',
                phone = '" . $u->getPhone() . "',
                age = " . $u->getAge() . ",
                joined_at = '" . $u->getJoinedAt()->format('Y-m-d H:i:s') . "',
                CantCompras = " . $u->getCantCompras() . "
                WHERE id = $id;");
        } catch (Exception $e) {
            throw new ServiceException("Error al actualizar el cliente: " . $e->getMessage());
        }
    }
}