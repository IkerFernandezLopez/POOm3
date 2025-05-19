<?php
declare(strict_types=1);

include_once __DIR__ . '/product.php';
include_once __DIR__ . '/Storable.php';
include_once '../Exception/BuildException.php';
include_once '../Exception/DataException.php';

class Libro extends Product implements Storable
{
    protected string $author;
    protected int $pages;
    protected string $location;
    protected int $stock;
    protected string $isbn;
    protected float $width;

    protected DateTime $dataPublish;
    protected DateTime $dateDisponible;

    public function __construct(
        string $name,
        float $price,
        string $author,
        int $pages,
        string $location,
        int $stock,
        string $details,
        string $isbn,
        DateTime|string $dataPublish,
        DateTime|string $dateDisponible,
        float $width
    ) {
        parent::__construct($name, $price, $details);

        $errores = [];

        if (trim($author) === '') {
            $errores[] = "Autor inválido.";
        } else {
            $this->author = $author;
        }

        if ($pages <= 0) {
            $errores[] = "Número de páginas inválido.";
        } else {
            $this->pages = $pages;
        }

        if (trim($location) === '') {
            $errores[] = "Ubicación inválida.";
        } else {
            $this->location = $location;
        }

        if ($stock < 0) {
            $errores[] = "Stock inválido (debe ser ≥ 0).";
        } else {
            $this->stock = $stock;
        }

        if (trim($isbn) === '') {
            $errores[] = "ISBN inválido.";
        } else {
            $this->isbn = $isbn;
        }

        // Validación de dataPublish
        if ($dataPublish instanceof DateTime) {
            $this->dataPublish = $dataPublish;
        } elseif (is_string($dataPublish)) {
            try {
                Checker::checkDate($dataPublish);
                $this->dataPublish = new DateTime($dataPublish);
            } catch (DataException $e) {
                $errores[] = "Fecha de publicación inválida: " . $e->getMessage();
                $this->dataPublish = new DateTime(); // fallback para evitar fatal error
            }
        } else {
            $errores[] = "Fecha de publicación inválida: tipo no soportado.";
            $this->dataPublish = new DateTime();
        }

        // Validación de dateDisponible
        if ($dateDisponible instanceof DateTime) {
            $this->dateDisponible = $dateDisponible;
        } elseif (is_string($dateDisponible)) {
            try {
                Checker::checkDate($dateDisponible);
                $this->dateDisponible = new DateTime($dateDisponible);
            } catch (DataException $e) {
                $errores[] = "Fecha de disponibilidad inválida: " . $e->getMessage();
                $this->dateDisponible = new DateTime();
            }
        } else {
            $errores[] = "Fecha de disponibilidad inválida: tipo no soportado.";
            $this->dateDisponible = new DateTime();
        }

        if ($width <= 0) {
            $errores[] = "Ancho inválido (debe ser > 0).";
        } else {
            $this->width = $width;
        }

        if (!empty($errores)) {
            throw new BuildException(implode(' ', $errores));
        }

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
