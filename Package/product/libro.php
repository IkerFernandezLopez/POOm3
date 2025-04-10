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
        $this->author = $author;
        $this->pages = $pages;
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
}