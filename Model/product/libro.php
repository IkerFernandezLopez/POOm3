<?php

include_once __DIR__ . '/product.php';
include_once __DIR__ . '/Storable.php';
include_once '../Exception/BuildException.php';
include_once '../Exception/DataException.php';
include_once '../Model/checker.php';

class Libro extends Product implements Storable
{
    protected int $id;
    protected string $author;
    protected int $pages;
    protected string $location;
    protected int $stock;
    protected string $isbn;
    protected float $width;
    protected string $details;
    protected DateTime $dataPublish;
    protected DateTime $dateDisponible;

    public function __construct(
        $id,
        $name,
        float $price,
        $author,
        $pages,
        $location,
        $stock,
        $details,
        $isbn,
        DateTime|string $dataPublish,
        DateTime|string $dateDisponible,
        $width
    ) {
        parent::__construct($name, $price, $details);

        if (!is_int($id) || $id <= 0) {
            throw new BuildException("ID inválido: debe ser un número entero positivo.");
        }

        if (!is_string($author) || Checker::checkString($author, 2) !== 0 || !preg_match('/^[\p{L}\s\-\.]{2,100}$/u', $author)) {
            throw new BuildException("Autor inválido: debe tener entre 2 y 100 caracteres, y contener solo letras, espacios, guiones o puntos.");
        }

        if (!is_int($pages) || $pages <= 0 || $pages > 10000) {
            throw new BuildException("Número de páginas inválido: debe estar entre 1 y 10,000.");
        }

        if (!is_string($location) || Checker::isEmpty($location) || strlen($location) > 255) {
            throw new BuildException("Ubicación inválida: texto obligatorio, máximo 255 caracteres.");
        }

        if (!is_int($stock) || $stock < 0 || $stock > 10000) {
            throw new BuildException("Stock inválido: debe ser un número entero entre 0 y 10000.");
        }

        if (!is_string($details) || Checker::isEmpty($details) || strlen($details) > 1000 || !preg_match('/^[\p{L}\s]+$/u', $details)) {
            throw new BuildException("Detalles inválidos: solo letras y espacios, obligatorio, máximo 1000 caracteres.");
        }

        if (!is_string($isbn) || Checker::checkISBN($isbn) !== 0) {
            throw new BuildException("ISBN inválido: debe empezar por 978 o 979 y tener 13 dígitos numéricos.");
        }

        if ($dataPublish instanceof DateTime) {
            $this->dataPublish = $dataPublish;
        } elseif (is_string($dataPublish)) {
            try {
                Checker::checkDate($dataPublish);
                $this->dataPublish = new DateTime($dataPublish);
            } catch (DataException $e) {
                throw new DataException("Fecha de publicación inválida: " . $e->getMessage());
            }
        } else {
            throw new BuildException("Fecha de publicación inválida: tipo no soportado.");
        }

        if ($dateDisponible instanceof DateTime) {
            $this->dateDisponible = $dateDisponible;
        } elseif (is_string($dateDisponible)) {
            try {
                Checker::checkDate($dateDisponible);
                $this->dateDisponible = new DateTime($dateDisponible);
            } catch (DataException $e) {
                throw new DataException("Fecha de disponibilidad inválida: " . $e->getMessage());
            }
        } else {
            throw new BuildException("Fecha de disponibilidad inválida: tipo no soportado.");
        }

        if (!is_numeric($width) || floatval($width) <= 0 || floatval($width) > 1000) {
            throw new BuildException("Ancho inválido: debe ser mayor a 0 y razonable.");
        }


        $this->id = $id;
        $this->author = trim($author);
        $this->pages = $pages;
        $this->location = trim($location);
        $this->stock = $stock;
        $this->isbn = trim($isbn);
        $this->width = floatval($width);
        $this->details = trim($details);

    }

    public function getDescription(): string
    {
        return "Libro: " . $this->name .
            ", Precio: " . number_format($this->price, 2) .
            ", Autor: " . $this->author .
            ", Páginas: " . $this->pages;
    }

    public function getDataPublish(): string
    {
        return $this->dataPublish->format('Y-m-d H:i:s');
    }

    public function getDateDisponible(): string
    {
        return $this->dateDisponible->format('Y-m-d H:i:s');
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getPages(): int
    {
        return $this->pages;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    public function setPages(int $pages): void
    {
        $this->pages = $pages;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getPeriod(): int
    {
        $diff = $this->dataPublish->diff($this->dateDisponible);
        return $diff->days;
    }


    public function getIntervals(int $days): array
    {
        $interval = new DateInterval('P' . $days . 'D');
        // Se clona dateDisponible para evitar modificar la propiedad original
        $endDate = clone $this->dateDisponible;
        $endDate->add(new DateInterval('P1D'));
        $period = new DatePeriod($this->dataPublish, $interval, $endDate);
        $fechas = [];
        foreach ($period as $dt) {
            $fechas[] = $dt->format('Y-m-d H:i:s');
        }
        return $fechas;
    }
}
