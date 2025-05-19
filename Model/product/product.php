<?php
declare(strict_types=1);

include_once '../Exception/BuildException.php';
include_once 'Marketable.php';

/**
 * Clase abstracta Product: plantilla para todos los productos vendibles.
 * Ya no impone restricción sobre el nombre; acepta cualquier string.
 */
abstract class Product implements Marketable
{
    protected string $name;
    protected float  $price;
    protected string $details;

    /**
     * @param string $name     Nombre del producto (libre, p.ej. "PHP Básico").
     * @param float  $price    Precio del producto (debe ser > 0).
     * @param string $details  Texto descriptivo (no puede estar vacío).
     *
     * @throws BuildException  Si falla la validación de precio o detalles.
     */
    public function __construct(string $name, float $price, string $details)
    {
        $errorMessage = "";

        // 1) Aceptamos cualquier nombre (antes restringía a "Libro"/"Software"/"Curso").
        $this->name = $name;

        // 2) Validar que el precio sea mayor que cero.
        if ($price <= 0.0) {
            $errorMessage .= "Precio inválido (debe ser mayor que 0). ";
        } else {
            $this->price = $price;
        }

        // 3) Validar que los detalles no estén vacíos.
        if (trim($details) === "") {
            $errorMessage .= "Detalles inválidos (campo vacío). ";
        } else {
            $this->details = $details;
        }

        // 4) Si se acumuló algún mensaje de error, lanzamos BuildException.
        if ($errorMessage !== "") {
            throw new BuildException($errorMessage);
        }
    }

    /**
     * Devuelve el nombre del producto.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Devuelve el precio del producto (float).
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Devuelve los detalles descriptivos del producto.
     */
    public function getDetails(): string
    {
        return $this->details;
    }

    /**
     * Permite modificar el nombre del producto.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Permite modificar el precio (float). Si quieres volver a validar (e.g. > 0),
     * puedes agregar lógica adicional aquí antes de asignar.
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * Permite modificar los detalles del producto.
     */
    public function setDetails(string $details): void
    {
        $this->details = $details;
    }

    /**
     * Las subclases deben implementar este método devolviendo una descripción.
     */
    public abstract function getDescription(): string;
}
