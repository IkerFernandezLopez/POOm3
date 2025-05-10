<?php
declare(strict_types=1);
include_once '../exceptions/exceptions.php';
include_once '../Package/product/product.php';
include_once '../Package/product/Storable.php';


class Libro extends Product implements Storable
{
    protected string $author, $location;
    protected int $pages, $stock;
    protected float $width;

    public function __construct($name, $price, $author, $pages, $location, $stock, $details, $width)
    {
        parent::__construct($name, $price, $details);

        $errorMessage = "";
        if ($author === "") {
            $errorMessage .= "Autor inválido. ";
        } else {
            $this->author = $author;
        }
        if ($pages <= 0) {
            $errorMessage .= "Número de páginas inválido. ";
        } else {
            $this->pages = $pages;
        }
        if ($location === "") {
            $errorMessage .= "Ubicación inválida. ";
        } else {
            $this->location = $location;
        }
        if ($stock <= 0) {
            $errorMessage .= "Stock inválido. ";
        } else {
            $this->stock = $stock;
        }
        if ($width <= 0) {
            $errorMessage .= "Ancho inválido. ";
        } else {
            $this->width = $width;
        }
    }
    public function getAuthor()
    {
        return $this->author;
    }
    public function getPages()
    {
        return $this->pages;
    }
    public function setAuthor($author)
    {
        $this->author = $author;
    }
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    public function getLocation(): string
    {
        return "Ubicación del libro: " . $this->location;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    // La función getDescription() devuelve una descripción del libro, incluyendo su nombre, precio, autor y número de páginas, pero esta puede ser distinta en otras subclases de Product.
    public function getDescription()
    {
        return "Libro: " . $this->name . ", Precio: " . $this->price . ", Autor: " . $this->author . ", Páginas: " . $this->pages;
    }
}