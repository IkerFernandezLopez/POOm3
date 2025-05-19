<?php

declare(strict_types=1);

include_once __DIR__ . '/MySQLAdapter.php';
include_once __DIR__ . '/../Model/product/libro.php';
include_once __DIR__ . '/../Exception/ServiceException.php';


class MySQLBookAdapter extends MySQLAdapter
{
    public function getBookById(int $id): Libro
    {
        $data = $this->readQuery("SELECT * FROM book WHERE codigo = $id;");
        if (count($data) > 0) {
            $row = $data[0];
            return new Libro(
                $row['name'],
                floatval($row['price']),
                $row['author'],                 
                intval($row['pages']),
                $row['location'],
                intval($row['stock']),
                $row['details'],
                $row['isbn'],
                $row['dataPublish'],
                $row['dateDisponible'],
                floatval($row['width'])
            );
        } else {
            throw new ServiceException("No se encontró el libro con código = $id");
        }
    }

    public function deleteBook(int $id): bool
    {
        return $this->writeQuery("DELETE FROM book WHERE codigo = $id;");
    }

    public function addBook(Libro $b): bool
    {
        $query = "INSERT INTO book (
            name, price, author, pages, location, stock, details, isbn, dataPublish, dateDisponible, width
        ) VALUES (
            '" . $b->getName() . "',
            " . $b->getPrice() . ",
            '" . $b->getAuthor() . "',
            " . $b->getPages() . ",
            '" . $b->getLocation() . "',
            " . $b->getStock() . ",
            '" . $b->getDetails() . "',
            '" . $b->getIsbn() . "',
            '" . $b->getDatapublish() . "',
            '" . $b->getDateDisponible() . "',
            " . $b->getWidth() . "
        );";

        return $this->writeQuery($query);
    }

    public function updateBookPages(int $codigo, int $newPages): bool
    {
        return $this->writeQuery("UPDATE book SET pages = $newPages WHERE codigo = $codigo;");
    }
}
