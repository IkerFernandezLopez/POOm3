<?php

include_once __DIR__ . '/MySQLAdapter.php';
include_once __DIR__ . '/../Model/stakeholders/Person.php';
include_once __DIR__ . '/../Exception/ServiceException.php';
class MysqlClientAdapter extends MySQLAdapter
{
    public function getClientById($id): Client
    {
        if (!is_int($id)) {
            throw new ServiceException("El id del cliente debe ser un número entero");
        }
        if ($id <= 0) {
            throw new ServiceException("El id del cliente no puede ser menor o igual a 0");
        }
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


    public function updateClientName(int $id, $name): bool
    {
        if (!is_string($name)) {
            throw new ServiceException("El nombre del cliente debe ser una cadena de texto");
        }
        if (!preg_match('/[a-zA-Z]/', $name)) {
            throw new ServiceException("El nombre del cliente debe contener al menos una letra");
        }
        if (empty(trim($name))) {
            throw new ServiceException("El nombre del cliente no puede estar vacío");
        }
        if (strlen($name) > 100) {
            throw new ServiceException("El nombre del cliente no puede tener más de 100 caracteres");
        }
        try {
            if (
                $this->writeQuery(
                    "UPDATE clients SET name = '" . $name . "' WHERE id = $id;"
                )
            ) {
                echo "Nombre del cliente actualizado exitosamente.\n";
                return true;
            }
        } catch (Exception $e) {
            throw new ServiceException("Error al actualizar el nombre del cliente: " . $e->getMessage());
        }
    }

    public function updateClientEmail(int $id, $email): bool
    {
        if (checker::checkEmail($email) != 0) {
            throw new ServiceException("El email del cliente no es válido");
        }
        if (!is_string($email)) {
            throw new ServiceException("El email del cliente debe ser una cadena de texto");
        }
        if (empty(trim($email))) {
            throw new ServiceException("El email del cliente no puede estar vacío");
        }
        if (strlen($email) > 255) {
            throw new ServiceException("El email del cliente no puede tener más de 100 caracteres");
        }
        try {
            if ($this->writeQuery("UPDATE clients SET email = '" . $email . "' WHERE id = $id;")) {
                echo "Email del cliente actualizado exitosamente.\n";
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new ServiceException("Error al actualizar el email del cliente: " . $e->getMessage());
        }
    }

    public function updateClientAddress(int $id, $address): bool
    {
        if (preg_match('/[^a-zA-Z0-9\s]/', $address)) {
            throw new ServiceException("La dirección del cliente no puede contener símbolos");
        }
        if (!is_string($address)) {
            throw new ServiceException("La dirección del cliente debe ser una cadena de texto");
        }
        if (empty(trim($address))) {
            throw new ServiceException("La dirección del cliente no puede estar vacía");
        }
        if (strlen($address) > 255) {
            throw new ServiceException("La dirección del cliente no puede tener más de 255 caracteres");
        }
        try {
            if ($this->writeQuery("UPDATE clients SET address = '" . $address . "' WHERE id = $id;")) {
                echo "Dirección del cliente actualizada exitosamente.\n";
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new ServiceException("Error al actualizar la dirección del cliente: " . $e->getMessage());
        }
    }

    public function updateClientPhone(int $id, $phone): bool
    {
        if (preg_match('/[^0-9\s]/', $phone)) {
            throw new ServiceException("El teléfono del cliente no puede contener símbolos");
        }
        if (!is_string($phone)) {
            throw new ServiceException("El teléfono del cliente debe ser una cadena de texto");
        }
        if (empty(trim($phone))) {
            throw new ServiceException("El teléfono del cliente no puede estar vacío");
        }
        if (strlen($phone) > 15) {
            throw new ServiceException("El teléfono del cliente no puede tener más de 15 caracteres");
        }
        if (strlen($phone) < 7) {
            throw new ServiceException("El teléfono del cliente no puede tener menos de 7 caracteres");
        }
        try {
            if ($this->writeQuery("UPDATE clients SET phone = '" . $phone . "' WHERE id = $id;")) {
                echo "Teléfono del cliente actualizado exitosamente.\n";
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new ServiceException("Error al actualizar el teléfono del cliente: " . $e->getMessage());
        }
    }

    public function updateClientAge(int $id, $age): bool
    {
        if (!is_int($age)) {
            throw new ServiceException("La edad del cliente debe ser un número entero");
        }
        if ($age > 120) {
            throw new ServiceException("La edad del cliente no puede ser mayor a 120");
        }
        if ($age < 18) {
            throw new ServiceException("La edad del cliente no puede ser menor a 18");
        }
        try {
            if ($this->writeQuery("UPDATE clients SET age = " . $age . " WHERE id = $id;")) {
                echo "Edad del cliente actualizada exitosamente.\n";
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new ServiceException("Error al actualizar la edad del cliente: " . $e->getMessage());
        }
    }

    public function updateClientJoinedAt(int $id, $joinedAt): bool
    {
        if (is_string($joinedAt)) {
            if (!preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/', $joinedAt)) {
                throw new ServiceException("El formato de la fecha debe ser 'YYYY-MM-DD HH:MM:SS'");
            }

            try {
                $joinedAt = new DateTime($joinedAt);
            } catch (Exception $e) {
                throw new ServiceException("La fecha de ingreso no es válida: " . $e->getMessage());
            }
        }

        if (!($joinedAt instanceof DateTime)) {
            throw new ServiceException("La fecha de ingreso debe ser un objeto DateTime o un string válido");
        }

        try {
            if ($this->writeQuery("UPDATE clients SET joined_at = '" . $joinedAt->format('Y-m-d H:i:s') . "' WHERE id = $id;")) {
                echo "Fecha de ingreso del cliente actualizada exitosamente.\n";
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new ServiceException("Error al actualizar la fecha de ingreso del cliente: " . $e->getMessage());
        }
    }


    public function updateClientCantCompras(int $id, $cantCompras): bool
    {
        if (!is_int($cantCompras)) {
            throw new ServiceException("La cantidad de compras del cliente debe ser un entero");
        }
        if ($cantCompras < 0) {
            throw new ServiceException("La cantidad de compras del cliente no puede ser negativa");
        }

        try {
            if ($this->writeQuery("UPDATE clients SET CantCompras = " . $cantCompras . " WHERE id = $id;")) {
                echo "Cantidad de compras del cliente actualizada exitosamente.\n";
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new ServiceException("Error al actualizar la cantidad de compras del cliente: " . $e->getMessage());
        }
    }

}