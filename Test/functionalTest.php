<?php
declare(strict_types=1);
include_once '../Model/product/product.php';
include_once '../Model/product/libro.php';
include_once '../Model/stakeholders/Client.php';


print "<br><b>Libro Test</b><br>";
try {
    $libro = new libro('Libro', 100, 'Autor', 200, 'Ubicación', 10, 'Detalles', '1234567890', '2023-01-01 12:30:00', '2023-01-01 12:30:00', 2.5);
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

print "<br><b>Client Test</b><br>";
try {
    $client = new Client(4, 'Susi', 'Susi@gmail.com', 'Susissadress 99', '692 09 12 22', 22, new DateTime('now'), 2);
    print $client->getName() . "<br>";
    print $client->getEmail() . "<br>";
    print $client->getAddress() . "<br>";
    print $client->getPhone() . "<br>";
    print $client->getAge() . "<br>";
    print $client->getJoinedAt()->format('Y-m-d H:i:s') . "<br>";
    print $client->getCantCompras() . "<br>";
} catch (Exception $e) {
    print "Error: " . $e->getMessage();
}
