<?php

include_once __DIR__ . '/../Model/checker.php';
include_once __DIR__ . '/../Exception/DataException.php';
include_once __DIR__ . '/../Model/stakeholders/Client.php';
include_once __DIR__ . '/../Model/product/libro.php';
include_once __DIR__ . '/../adapter/MySQLBookAdapter.php';
include_once __DIR__ . '/../adapter/MysqlClientAdapter.php';
include_once __DIR__ . '/../Model/stakeholders/Client.php';



$bookAdapter = new MySQLBookAdapter();




// try {
//     $libro = new Libro(
//         2,
//         'Libro' . random_int(1, 1000),
//         random_int(10, 100),
//         'Juan Pérez',
//         200,
//         'Barcelona',
//         77,
//         'Buen libro introductorio a PHP',
//         '978-31-614-82-22-4',
//         '2004-11-15 12:30:00',
//         new DateTime('now'),
//         rand(100, 500) / 100
//     );
//     $bookAdapter->addBook($libro);
//     print "Libro insertado correctamente.<br>";
// } catch (TypeError $e) {
//     print "Error de tipo en la construcción del libro: Asegurate de introducir los tipos de valores correctos <br>";
// } catch (BuildException $e) {
//     print "Error de validación: " . $e->getMessage() . "<br>";
// } catch (Exception $e) {
//     print "Error inesperado: " . $e->getMessage() . "<br>";
// }


// $codigo = $libro->getId();


// // Test GETTERS
// try {
//     $libro = $bookAdapter->getBookById($codigo);
//     print "Libro recuperado: " . $libro->getName() . "<br>";
// } catch (ServiceException $e) {
//     print "Error al recuperar libro: " . $e->getMessage() . "<br>";
// }




// // TEST UPDATES

// // -------------UPDATE NAME
// try {
//     $libro = $bookAdapter->updateBookName($codigo, 'Nuevo Nombre');
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo Name: " . $e->getMessage();
// }

// // -------------UPDATE PRICE
// try {
//     $libro = $bookAdapter->updateBookPrice($codigo, 122.31);
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo Price: " . $e->getMessage();
// }

// // -------------UPDATE AUTHOR
// try {
//     $libro = $bookAdapter->updateBookAuthor($codigo, 'Nuevo Autor');
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo Author: " . $e->getMessage();
// }

// // -------------UPDATE PAGES
// try {
//     $libro = $bookAdapter->updateBookPages($codigo, 140);
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo Pages: " . $e->getMessage();
// }

// // -------------UPDATE LOCATION
// try {
//     $libro = $bookAdapter->updateBookLocation($codigo, 'Nuevo Ubicación');
// } catch (Throwable $e) {
//     print "<br>Error capturado En el campo Location: " . $e->getMessage();
// }


// // -------------UPDATE STOCK
// try {
//     $libro = $bookAdapter->updateBookStock($codigo, 22);
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo Stock: " . $e->getMessage();
// }


// // -------------UPDATE DETAILS
// try {
//     $libro = $bookAdapter->updateBookDetails($codigo, 'Nuevo Detalles');
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo Details: " . $e->getMessage();
// }


// // -------------UPDATE ISBN
// try {
//     $libro = $bookAdapter->updateBookIsbn($codigo, '9782222222222');
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo Isbn: " . $e->getMessage();
// }

// // -------------UPDATE DATEDISPONIBLE
// try {
//     $libro = $bookAdapter->updateBookDateDisponible($codigo, 'Nuevo Nombre');
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo DatePublish: " . $e->getMessage();
// }

// // -------------UPDATE WIDTH
// try {
//     $libro = $bookAdapter->updateBookWidth($codigo, 'NuevoNombre');
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo Width: " . $e->getMessage();
// }

// // -------------UPDATE DATAPUBLISH
// try {
//     $libro = $bookAdapter->updateBookDateDisponible($codigo, 'Nuevo ');
// } catch (Throwable $e) {
//     print "<br>Error capturado en el campo DataPublish: " . $e->getMessage();
// }



// ---- TEST DELETE BOOK

// try {
//     $bookAdapter->deleteBook(22);
//     print "Libro eliminado correctamente.";
// } catch (ServiceException $e) {
//     print "Error al eliminar libro: " . $e->getMessage();
// }





// TEST CLIENTS


$clientAdapter = new MysqlClientAdapter();

try {
    $rand = random_int(3, 1000);
    $cliente = new Client(
        4,
        'Cliente ' . $rand,
        'cliente' . $rand . '@example.com',
        'Calle ' . random_int(1, 100) . ', Ciudad ' . random_int(1, 10),
        '+34 ' . random_int(000, 999) . ' ' . random_int(000, 999) . ' ' . random_int(000, 999),
        random_int(18, 60),
        new DateTime('now'),
        22,
    );
    $clientAdapter->addClient($cliente);
    print "Cliente insertado correctamente.";
} catch (BuildException $e) {
    print "Error al insertar cliente: " . $e->getMessage();
} catch (ServiceException $e) {
    print "Error al insertar cliente: " . $e->getMessage();
} catch (Throwable $e) {
    print "Error inesperado: " . $e->getMessage();
} catch (Exception $e) {
    print "Error inesperado: " . $e->getMessage();
}

$id = $cliente->getId();



// TEST GETTERS
try {
    $cliente = $clientAdapter->getClientById($id);
    print "<br><br><b>Cliente recuperado: </b>" . $cliente->getName() . "<br>" . $cliente->getEmail() . "<br>" .
        $cliente->getAddress() . "<br>" .
        $cliente->getPhone() . "<br>" .
        $cliente->getAge() . "<br>" .
        $cliente->getJoinedAt()->format('Y-m-d H:i:s') . "<br>" .
        $cliente->getCantCompras() . "<br><br><br>";
} catch (ServiceException $e) {
    print "<br>Error al recuperar cliente: " . $e->getMessage() . "<br>";
}


// TEST UPDATES


// //-------------UPDATE NAME
try {
    // print "Test updates Client<br>";
    $client = $clientAdapter->updateClientName($id, 'Novonovno');
} catch (Throwable $e) {
    print "<br>Error capturado en el campo Name: " . $e->getMessage() . "<br>";
}



// //-------------UPDATE EMAIL
try {
    // print "Test updates Client<br>";
    $client = $clientAdapter->updateClientEmail($id, 'Iker@gmail.com');
} catch (Throwable $e) {
    print "<br>Error capturado en el campo Name: " . $e->getMessage() . "<br>";
}


// //-------------UPDATE ADDRESS
try {
    // print "Test updates Client<br>";
    $client = $clientAdapter->updateClientAddress($id, 'Nuev 60 60 06 Nombre');
} catch (Throwable $e) {
    print "<br>Error capturado en el campo Name: " . $e->getMessage() . "<br>";
}


// //-------------UPDATE PHONE
try {
    // print "Test updates Client<br>";
    $client = $clientAdapter->updateClientPhone($id, "23456789098");
} catch (Throwable $e) {
    print "<br>Error capturado en el campo Name: " . $e->getMessage() . "<br>";
}


// //-------------UPDATE AGE
try {
    // print "Test updates Client<br>";
    $client = $clientAdapter->updateClientAge($id, 20);
} catch (Throwable $e) {
    print "<br>Error capturado en el campo Name: " . $e->getMessage() . "<br>";
}


// //-------------UPDATE JOINEDAT
try {
    // print "Test updates Client<br>";
    $client = $clientAdapter->updateClientJoinedAt($id, '2023-10-01 12:30:00');
} catch (Throwable $e) {
    print "<br>Error capturado en el campo Name: " . $e->getMessage() . "<br>";
}


// //-------------UPDATE CANTCOMPRAS
try {
    // print "Test updates Client<br>";
    $client = $clientAdapter->updateClientCantCompras($id, 20);
} catch (Throwable $e) {
    print "<br>Error capturado en el campo Name: " . $e->getMessage() . "<br>";
}



// TEST GETTERS
try {
    $cliente = $clientAdapter->getClientById($id);
    print "Cliente recuperado: " . $cliente->getName() . "<br>";
} catch (ServiceException $e) {
    print "Error al recuperar cliente: " . $e->getMessage() . "<br>";
}





// // TEST DELETE CLIENT
try {
    $clientAdapter->deleteClient($id);
    // print "Cliente eliminado correctamente.";
} catch (ServiceException $e) {
    print "<br>Error al eliminar cliente: " . $e->getMessage();
}
