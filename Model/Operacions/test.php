<?php
include_once 'Operacio.php';
include_once 'address.php';
include_once 'Compra.php';
include_once 'Venta.php';


print "<b>Test Address</b><br>";
try {
    $test = new Address('España', 'Gavà', 'AV. eramprunya', '08850');
    print $test->getPais() . "<br>";

    // test de setPais()
    $test->setPais("Castañuelas");
    print $test->getPais() . "<br>";

    print $test->getCiudad() . "<br>";
    print $test->getDireccion() . "<br>";
    print $test->getCodigoPostal() . "<br>";
} catch (BuildException $e) {
    print "Error: " . $e->getMessage();

}

print "<br><b>Test Compra</b><br>";
try {
    $test1 = new Compra(20, 120, '20 ENERO', 25, '5', '25 ENERO', 21, 'compra');
    print "tipo de operacion <b>getType() - </b>" . $test1->getType() . "<br>";
    print "Precio " . $test1->getPrice() . "<br>";
    print "Codigo Proovedor " . $test1->getCodiProovedor() . "<br>";
    print "Porcentaje de Impuestos " . $test1->getImpuestos() . "<br>";
    print "<b>GetTotalPrice</b> " . $test1->getTotalPrice() . "<br>";
    print "<b>getAllDates()</b> - " . $test1->getAllDates();
} catch (BuildException $e) {
    print "Error: " . $e->getMessage();

}

print "<br><br><b>Test Venta</b><br>";
try {
    $test2 = new Venta(40, '25 ENERO', '5', 'venta', 20, 102, '20 de enero', 100);
    print "Tipo de operacion <b>getType() - </b>" . $test2->getType() . "<br>";
    print "Codigo de Cliente " . $test2->getCodiClient() . "<br>";
    print "<b>getAllDates()</b> - " . $test2->getAllDates() . "<br>";
    print "Sobrecargo - " . $test2->getSobrecargo() . "<br>";
    print "<b>GetTotalPrice</b> - " . $test2->getTotalPrice();

} catch (BuildException $e) {
    print "Error: " . $e->getMessage();

}