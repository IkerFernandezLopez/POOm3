<?php
declare(strict_types=1);
include_once '../Package/product/product.php';
include_once '../Package/product/libro.php';
include_once '../Package/product/curso.php';
include_once '../Package/product/software.php';


print "<br><b>Libro Test</b><br>";
try {
    $libro = new libro('Libro', 100, 'Autor', 200, 'Ubicación', 10, 'Detalles', 1.5);
    print $libro->getName() . "<br>";
    print $libro->getPrice() . "<br>";
    print $libro->getAuthor() . "<br>";
    print $libro->getPages() . "<br>";
    print $libro->getLocation() . "<br>";
    print $libro->getStock() . "<br>";
    print $libro->getDescription() . "<br>";
} catch (Exception $e) {
    print "Error: " . $e->getMessage();
}

print "<br><b>Curso Test</b><br>";
try {
    $curso = new curso('Curso', 100, 'Instructor', 30, 'Detalles');
    print $curso->getName() . "<br>";
    print $curso->getPrice() . "<br>";
    print $curso->getInstructor() . "<br>";
    print $curso->getDuration() . "<br>";
    print $curso->getDescription() . "<br>";
} catch (Exception $e) {
    print "Error: " . $e->getMessage();
}

print "<br><b>Software Test</b><br>";
try {
    $software = new software('Software', 100, '1.0', 'Licencia', 'Detalles');
    print $software->getName() . "<br>";
    print $software->getPrice() . "<br>";
    print $software->getVersion() . "<br>";
    print $software->getLicense() . "<br>";
    print $software->getDescription() . "<br>";
} catch (Exception $e) {
    print "Error: " . $e->getMessage();
}