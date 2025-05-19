<?php

include_once __DIR__ . '/../Model/checker.php';
include_once __DIR__ . '/../Exception/DataException.php';
include_once __DIR__ . '/../Model/stakeholders/Client.php';
include_once __DIR__ . '/../Model/product/libro.php';
include_once __DIR__ . '/../adapter/MySQLBookAdapter.php';
include_once __DIR__ . '/../adapter/MysqlClientAdapter.php';


// $bookAdapter = new MySQLBookAdapter();

// $libro = new Libro(
//     'Libro' . random_int(1, 1000),
//     random_int(10, 100),
//     'Juan Pérez',
//     200,
//     'Barcelona',
//     random_int(1, 20),
//     'Buen libro introductorio a PHP',
//     strval(random_int(1000000000, 9999999999)),
//     '2023-01-01 12:30:00',
//     new DateTime('now'),
//     2.5
// );

// try {
//     $bookAdapter->addBook($libro);
//     echo "Libro insertado correctamente.<br>";
// } catch (Exception $e) {
//     echo "Error al insertar libro: " . $e->getMessage() . "<br>";
// }


// $clientAdapter = new MysqlClientAdapter();

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
// } catch (Exception $e) {
//     echo "Error al insertar cliente: " . $e->getMessage();
// }


// $bookAdapter = new MySQLBookAdapter();

// try {
//     $libro = new Libro(
//         'Libro' . random_int(1, 1000),
//         random_int(10, 100),
//         'Juan Pérez',
//         200,
//         'Barcelona',
//         random_int(1, 20),
//         'Buen libro introductorio a PHP',
//         strval(random_int(1000000000, 9999999999)),
//         '2004-11-15 12:30:00',
//         new DateTime('now'),
//         rand(100, 500) / 100
//     );
//     $bookAdapter->addBook($libro);
//     echo "Libro insertado correctamente.<br>";
// } catch (BuildException $e) {
//     echo "Error al insertar libro: " . $e->getMessage() . "<br>";
// }


// $clientAdapter = new MysqlClientAdapter();

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











// ---------------------------------------------- TESTING ---------------------------------------------------
$testCases = [
   // Autor vacío
    ['author' => ''],

   // Páginas negativas o cero
    ['pages' => 0],
    ['pages' => -5],

    // Ubicación vacía
    ['location' => ''],

    // Stock negativo
    ['stock' => -1],

    // ISBN vacío
    ['isbn' => ''],

    // Fecha publicación mal formato (string)
    ['dataPublish' => '15-11-2004 12:30:00'],  // formato inválido (DD-MM-YYYY vs YYYY-MM-DD)

    // Fecha publicación año fuera de rango
    ['dataPublish' => '1899-11-15 12:30:00'],
    ['dataPublish' => '2026-01-01 00:00:00'],

    // Fecha publicación con hora mal (hora > 23)
    ['dataPublish' => '2004-11-15 25:00:00'],

    // Fecha disponibilidad mal formato
    ['dateDisponible' => '2023-02-30 12:30:00'], // fecha inválida

    // Ancho <= 0
    ['width' => 0],
    ['width' => -10],
];


foreach ($testCases as $case) {
    try {
        $libro = new Libro(
            'Libro' . random_int(1, 1000),
            random_int(10, 100),
            $case['author'] ?? 'Juan Pérez',
            $case['pages'] ?? 200,
            $case['location'] ?? 'Barcelona',
            $case['stock'] ?? random_int(1, 20),
            'Buen libro introductorio a PHP',
            $case['isbn'] ?? strval(random_int(1000000000, 9999999999)),
            $case['dataPublish'] ?? '2004-11-15 12:30:00',
            $case['dateDisponible'] ?? new DateTime('now'),
            $case['width'] ?? (rand(100, 500) / 100)
        );
        echo "Libro insertado correctamente.<br>";
    } catch (BuildException $e) {
        echo "Error al insertar libro: " . $e->getMessage() . "<br>";
    }
}
