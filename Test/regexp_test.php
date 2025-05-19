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
//         'Libro' . random_int(1, 1000),
//         random_int(10, 100),
//         'Juan Pérez',
//         200,
//         'Barcelona',
//         '77777',
//         'Buen libro introductorio a PHP',
//         '978-3-16-148410-0',
//         '2004-11-15 12:30:00',
//         new DateTime('now'),
//         rand(100, 500) / 100
//     );
//     $bookAdapter->addBook($libro);
//     echo "Libro insertado correctamente.<br>";
// } catch (TypeError $e) {
//     echo "Error de tipo en la construcción del libro: Asegurate de introducir los tipos de valores correctos <br>";
// } catch (BuildException $e) {
//     echo "Error de validación: " . $e->getMessage() . "<br>";
// } catch (Exception $e) {
//     echo "Error inesperado: " . $e->getMessage() . "<br>";
// }





// Test GETTERS
// try {
//     $libro = $bookAdapter->getBookById(1);
//     echo "Libro recuperado: " . $libro->getName() . "<br>";
// } catch (ServiceException $e) {
//     echo "Error al recuperar libro: " . $e->getMessage() . "<br>";
// }






// ---------------------------------------------- TESTING INSERTS ---------------------------------------------------
// $testCases = [
//    // Autor vacío
//     ['author' => ''],

//    // Páginas negativas o cero
//     ['pages' => 0],
//     ['pages' => -5],

//     // Ubicación vacía
//     ['location' => ''],

//     // Stock negativo
//     ['stock' => -1],

//     // ISBN vacío
//     ['isbn' => ''],

//     // Fecha publicación mal formato (string)
//     ['dataPublish' => '15-11-2004 12:30:00'],  // formato inválido (DD-MM-YYYY vs YYYY-MM-DD)

//     // Fecha publicación año fuera de rango
//     ['dataPublish' => '1899-11-15 12:30:00'],
//     ['dataPublish' => '2026-01-01 00:00:00'],

//     // Fecha publicación con hora mal (hora > 23)
//     ['dataPublish' => '2004-11-15 25:00:00'],

//     // Fecha disponibilidad mal formato
//     ['dateDisponible' => '2023-02-30 12:30:00'], // fecha inválida

//     // Ancho <= 0
//     ['width' => 0],
//     ['width' => -10],
// ];


// foreach ($testCases as $case) {
//     try {
//         $libro = new Libro(
//             'Libro' . random_int(1, 1000),
//             random_int(10, 100),
//             $case['author'] ?? 'Juan Pérez',
//             $case['pages'] ?? 200,
//             $case['location'] ?? 'Barcelona',
//             $case['stock'] ?? random_int(1, 20),
//             'Buen libro introductorio a PHP',
//             $case['isbn'] ?? strval(random_int(1000000000, 9999999999)),
//             $case['dataPublish'] ?? '2004-11-15 12:30:00',
//             $case['dateDisponible'] ?? new DateTime('now'),
//             $case['width'] ?? (rand(100, 500) / 100)
//         );
//         echo "Libro insertado correctamente.<br>";
//     } catch (TypeError $e) {
//     echo "Error de tipo en la construcción del libro: Asegurate de introducir los tipos de valores correctos <br>";
// } catch (BuildException $e) {
//     echo "Error de validación: " . $e->getMessage() . "<br>";
// } catch (Exception $e) {
//     echo "Error inesperado: " . $e->getMessage() . "<br>";
// }
// }




// TEST UPDATES

// -------------UPDATE NAME
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookName(35, 'Nuevo Nombre');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Name: " . $e->getMessage();
// }

// -------------UPDATE PRICE
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookPrice(35, 122.31);
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Price: " . $e->getMessage();
// }

// -------------UPDATE AUTHOR
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookAuthor(35, 'Nuevo Autor');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Author: " . $e->getMessage();
// }

// -------------UPDATE PAGES
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookPages(35, 140);
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Pages: " . $e->getMessage();
// }

// -------------UPDATE LOCATION
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookLocation(35, 'Nuevo Ubicación');
// } catch (Throwable $e) {
//     echo "Error capturado En el campo Location: " . $e->getMessage();
// }


// -------------UPDATE STOCK
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookStock(35, 'popo');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Stock: " . $e->getMessage();
// }


// -------------UPDATE DETAILS
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookDetails(35, 'Nuevo Detalles');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Details: " . $e->getMessage();
// }


// -------------UPDATE ISBN
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookIsbn(35, '9782222222');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Isbn: " . $e->getMessage();
// }

// -------------UPDATE DATEDISPONIBLE
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookDateDisponible(35, 'Nuevo Nombre');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo DatePublish: " . $e->getMessage();
// }

// -------------UPDATE WIDTH
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookWidth(35, 'NuevoNombre');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Width: " . $e->getMessage();
// }

// -------------UPDATE DATAPUBLISH
// try {
//     echo "Test updates libro<br>";
//     $libro = $bookAdapter->updateBookDateDisponible(35, 'Nuevo ');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo DataPublish: " . $e->getMessage();
// }



// ---- TEST DELETE BOOK

// try {
//     $bookAdapter->deleteBook(22);
//     echo "Libro eliminado correctamente.";
// } catch (ServiceException $e) {
//     echo "Error al eliminar libro: " . $e->getMessage();
// }





// TEST CLIENTS


$clientAdapter = new MysqlClientAdapter();

// try {
//     $rand = random_int(1, 1000);
//     $cliente = new Client(
//         random_int(1, 1000),
//         'Cliente ' . $rand,
//         'cliente' . $rand . '@example.com',
//         'Calle ' . random_int(1, 100) . ', Ciudad ' . random_int(1, 10),
//         '+34 ' . random_int(000, 999) . ' ' . random_int(000, 999) . ' ' . random_int(000, 999),
//         random_int(18, 60),
//         new DateTime('now'),
//         random_int(1, 15),
//     );
//     $clientAdapter->addClient($cliente);
//     echo "Cliente insertado correctamente.";
// } catch (BuildException $e) {
//     echo "Error al insertar cliente: " . $e->getMessage();
// }





// TEST GETTERS
// try {
//     $cliente = $clientAdapter->getClientById(30);
//     echo "Cliente recuperado: " . $cliente->getName() . "<br>";
// } catch (ServiceException $e) {
//     echo "Error al recuperar cliente: " . $e->getMessage() . "<br>";
// }


// TEST UPDATES


//-------------UPDATE NAME
// try {
//     echo "Test updates Client<br>";
//     $client = $clientAdapter->updateClientName(32, 'Novonovno');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Name: " . $e->getMessage();
// }



//-------------UPDATE EMAIL
// try {
//     echo "Test updates Client<br>";
//     $client = $clientAdapter->updateClientEmail(32, 'Iker@gmail.com');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Name: " . $e->getMessage();
// }


//-------------UPDATE ADDRESS
// try {
//     echo "Test updates Client<br>";
//     $client = $clientAdapter->updateClientAddress(32, 'Nuev 60 60 06 Nombre');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Name: " . $e->getMessage();
// }


//-------------UPDATE PHONE
// try {
//     echo "Test updates Client<br>";
//     $client = $clientAdapter->updateClientPhone(32, "23456789098");
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Name: " . $e->getMessage();
// }


//-------------UPDATE AGE
// try {
//     echo "Test updates Client<br>";
//     $client = $clientAdapter->updateClientAge(35, 20);
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Name: " . $e->getMessage();
// }


//-------------UPDATE JOINEDAT
// try {
//     echo "Test updates Client<br>";
//     $client = $clientAdapter->updateClientJoinedAt(35, '2023-10-01 12:30:00');
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Name: " . $e->getMessage();
// }


//-------------UPDATE CANTCOMPRAS
// try {
//     echo "Test updates Client<br>";
//     $client = $clientAdapter->updateClientCantCompras(35, 20);
// } catch (Throwable $e) {
//     echo "Error capturado en el campo Name: " . $e->getMessage();
// }


// TEST DELETE CLIENT
// try {
//     $clientAdapter->deleteClient('aaa');
//     echo "Cliente eliminado correctamente.";
// } catch (ServiceException $e) {
//     echo "Error al eliminar cliente: " . $e->getMessage();
// }




// $clientesData = [
//     [
//         // TIENE QUE ENTRAR
//         'id' => 1,
//         'name' => 'Ana Gómez',
//         'email' => 'ana.gomez@example.com',
//         'address' => 'Calle Real 45',
//         'phone' => '+34 600 123 456',
//         'age' => 28,
//         'registrationDate' => new DateTime('2022-01-01'),
//         'level' => 3,
//     ],
//     [
//         // NO TIENE QUE ENTRAR
//         'id' => 2,
//         'name' => '123456',
//         'email' => 'correo@invalido',
//         'address' => '',
//         'phone' => 999999999,
//         'age' => -5,
//         'registrationDate' => 'noesfecha',
//         'level' => 100,
//     ],
//     [
//         // NO TIENE QUE ENTRAR
//         'id' => 3,
//         'name' => '@@@###',
//         'email' => 'user@@example..com',
//         'address' => 'Calle!@#$%',
//         'phone' => '+34 (666) 555-444',
//         'age' => 'treinta',
//         'registrationDate' => new DateTime(),
//         'level' => 0,
//     ],
//     [
//         // TIENE QUE ENTRAR
//         'id' => 4,
//         'name' => 'Laura Fernández',
//         'email' => 'laura.fernandez@example.com',
//         'address' => 'Paseo de la Castellana 100',
//         'phone' => '+34 622 111 222',
//         'age' => 35,
//         'registrationDate' => new DateTime('2023-06-01'),
//         'level' => 5,
//     ],
//     [
//         // NO TIENE QUE ENTRAR
//         'id' => 5,
//         'name' => null,
//         'email' => null,
//         'address' => null,
//         'phone' => null,
//         'age' => null,
//         'registrationDate' => null,
//         'level' => null,
//     ],
// ];

// foreach ($clientesData as $i => $data) {
//     try {
//         $cliente = new Client(
//             $data['id'],
//             $data['name'],
//             $data['email'],
//             $data['address'],
//             $data['phone'],
//             $data['age'],
//             $data['registrationDate'],
//             $data['level'],
//         );
//         $clientAdapter->addClient($cliente);
//         echo "Cliente '{$data['name']}' insertado correctamente.<br>";
//     } catch (BuildException $e) {
//         echo "BuildException en cliente #{$i} ('{$data['name']}'?): " . $e->getMessage() . "<br>";
//     } catch (TypeError $e) {
//         echo "TypeError: {$data['name']} " . $e->getMessage() . "<br>";
//     } catch (Exception $e) {
//         echo "Excepción general : " . $e->getMessage() . "<br>";
//     }
// }
