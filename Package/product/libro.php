<?php
include_once '../exceptions/exceptions.php';
include_once '../Package/product/product.php';
class Libro extends Product
{
    protected string $author;
    protected int $pages;

    public function __construct($name, $price, $author, $pages)
    {
        parent::__construct($name, $price);

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

    // La función getDescription() devuelve una descripción del libro, incluyendo su nombre, precio, autor y número de páginas, pero esta puede ser distinta en otras subclases de Product.
    public function getDescription()
    {
        return "Libro: " . $this->name . ", Precio: " . $this->price . ", Autor: " . $this->author . ", Páginas: " . $this->pages;
    }
}