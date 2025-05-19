<?php


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

    public function updateBookName(int $codigo, string $newName): bool
    {
        if (!is_string($newName)) {
            throw new Exception("El nombre debe ser una cadena de texto.");
        }
        if (!preg_match('/[a-zA-Z]/', $newName)) {
            throw new Exception("El nombre debe contener al menos una letra.");
        }

        if (empty(trim($newName))) {
            throw new Exception("El nombre no puede estar vacío.");
        }
        if (strlen($newName) > 100) {
            throw new Exception("El nombre no puede tener más de 100 caracteres.");
        }

        return $this->writeQuery("UPDATE book SET name = '$newName' WHERE codigo = $codigo;");
    }

    public function updateBookPrice(int $codigo, mixed $newPrice): bool
    {
        if (!is_numeric($newPrice) && !is_float($newPrice) || $newPrice < 0 || $newPrice > 9999.99) {
            throw new Exception("El precio debe ser un número válido");
        }

        if ($newPrice <= 0) {
            throw new Exception("El precio debe ser mayor que 0.");
        }
        if ($newPrice > 9999.99) {
            throw new Exception("El precio no puede ser mayor que 9999.99.");
        }
        return $this->writeQuery("UPDATE book SET price = $newPrice WHERE codigo = $codigo;");
    }

    public function updateBookAuthor(int $codigo, $newAuthor): bool
    {
        if (!is_string($newAuthor)) {
            throw new Exception("El autor debe ser una cadena de texto.");
        }
        if (empty(trim($newAuthor))) {

            throw new Exception("El autor no puede estar vacío.");
        }
        if (strlen($newAuthor) > 100) {
            throw new Exception("El nombre del autor no puede exceder 100 caracteres.");
        }

        return $this->writeQuery("UPDATE book SET author = '$newAuthor' WHERE codigo = $codigo;");
    }



    public function updateBookPages(int $codigo, $newPages): bool
    {
        if (!is_int($newPages) || $newPages <= 0 || $newPages > 10000) {
            throw new Exception("El número de páginas debe ser un entero positivo menor a 10,000.");
        }

        return $this->writeQuery("UPDATE book SET pages = $newPages WHERE codigo = $codigo;");
    }

    public function updateBookLocation(int $codigo, $newLocation): bool
    {

        if (!is_string($newLocation)) {
            throw new Exception("La ubicación debe ser una cadena de texto.");
        }
        if (empty(trim($newLocation))) {
            throw new Exception("La ubicación no puede estar vacía.");
        }
        if (strlen($newLocation) > 100) {
            throw new Exception("La ubicación no puede exceder los 100 caracteres.");
        }

        return $this->writeQuery("UPDATE book SET location = '$newLocation' WHERE codigo = $codigo;");
    }

    public function updateBookStock(int $codigo, $newStock): bool
    {
        if (!is_int($newStock) || $newStock < 0 || $newStock > 100000) {
            throw new Exception("El stock debe ser un número entero entre 0 y 100000.");
        }
        return $this->writeQuery("UPDATE book SET stock = $newStock WHERE codigo = $codigo;");
    }

    public function updateBookDetails(int $codigo, $newDetails): bool
    {

        if (!is_string($newDetails)) {
            throw new Exception("Los detalles deben ser una cadena de texto.");
        }
        if (empty(trim($newDetails))) {
            throw new Exception("Los detalles no pueden estar vacíos.");
        }
        if (strlen($newDetails) > 1000) {
            throw new Exception("Los detalles no pueden exceder 1000 caracteres.");
        }

        return $this->writeQuery("UPDATE book SET details = '$newDetails' WHERE codigo = $codigo;");
    }

    public function updateBookIsbn(int $codigo, string $newIsbn): bool
    {
        if (checker::checkISBN($newIsbn) !== 0) {
            throw new Exception("El ISBN debe tener 10 o 13 dígitos numéricos.");
        }

        return $this->writeQuery("UPDATE book SET isbn = '$newIsbn' WHERE codigo = $codigo;");
    }

    public function updateBookDataPublish(int $codigo, string $newDataPublish): bool
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $newDataPublish);
        if (!$date || $date->format('Y-m-d H:i:s') !== $newDataPublish) {
            throw new Exception("La fecha debe tener el formato 'YYYY-MM-DD HH:MM:SS'.");
        }

        return $this->writeQuery("UPDATE book SET dataPublish = '$newDataPublish' WHERE codigo = $codigo;");
    }
    public function updateBookWidth(int $codigo, $newWidth): bool
    {
        if (!is_float($newWidth) && !is_numeric($newWidth)) {
            throw new Exception("El ancho debe ser un número.");
        }
        if ($newWidth < 0) {
            throw new Exception("El ancho no puede ser negativo.");
        }
        return $this->writeQuery("UPDATE book SET width = $newWidth WHERE codigo = $codigo;");
    }

    public function updateBookDateDisponible(int $codigo, string $newDateDisponible): bool
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $newDateDisponible);
        if (!$date || $date->format('Y-m-d H:i:s') !== $newDateDisponible) {
            throw new Exception("La fecha debe tener el formato 'YYYY-MM-DD HH:MM:SS'.");
        }

        return $this->writeQuery("UPDATE book SET dateDisponible = '$newDateDisponible' WHERE codigo = $codigo;");
    }

}
