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

        if (!is_string($author) || trim($author) === '' || !preg_match('/^[\p{L}\s\-\.]{2,100}$/u', $author)) {
            $errores[] = "Autor inválido (debe tener entre 2 y 100 caracteres, solo letras, espacios, guiones o puntos).";
        } else {
            $this->author = htmlspecialchars(trim($author), ENT_QUOTES, 'UTF-8');
        }

        if (!is_int($pages) || $pages <= 0 || $pages > 10000) {
            $errores[] = "Número de páginas inválido (debe ser entre 1 y 10,000).";
        } else {
            $this->pages = $pages;
        }

        if (!is_string($location) || trim($location) === '' || strlen($location) > 255) {
            $errores[] = "Ubicación inválida (texto obligatorio, máx 255 caracteres).";
        } else {
            $this->location = htmlspecialchars(trim($location), ENT_QUOTES, 'UTF-8');
        }

        if (!is_int($stock) || $stock < 0 || $stock > 1000000) {
            $errores[] = "Stock inválido (debe ser ≥ 0 y razonable).";
        } else {
            $this->stock = $stock;
        }

        if (!is_string($isbn) || !preg_match('/^[\d\-]{10,17}$/', $isbn)) {
            $errores[] = "ISBN inválido (formato esperado: 10 a 17 dígitos y guiones).";
        } else {
            $this->isbn = htmlspecialchars(trim($isbn), ENT_QUOTES, 'UTF-8');
        }

        if ($dataPublish instanceof DateTime) {
            $this->dataPublish = $dataPublish;
        } elseif (is_string($dataPublish)) {
            try {
                Checker::checkDate($dataPublish);
                $this->dataPublish = new DateTime($dataPublish);
            } catch (DataException $e) {
                $errores[] = "Fecha de publicación inválida: " . $e->getMessage();
                $this->dataPublish = new DateTime();
            }
        } else {
            $errores[] = "Fecha de publicación inválida: tipo no soportado.";
            $this->dataPublish = new DateTime();
        }

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

        if (!is_numeric($width) || $width <= 0 || $width > 1000) {
            $errores[] = "Ancho inválido (debe ser > 0 y razonable).";
        } else {
            $this->width = floatval($width);
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
