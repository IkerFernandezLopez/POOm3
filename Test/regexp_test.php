<?php

include_once '../Model/checker.php';
include_once '../Exception/DataException.php';
include_once '../Model/stakeholders/Client.php';



// $ip = '211.111.211.111';

// print "IP Address Validation <br>";
// print "The input is : " . $ip . "<br>";
// print "----------------------------------<br>";

// try {
//     checker::checkIpAddress($ip);
// } catch (DataException $e) {
//     print "Exception: " . $e->getMessage();
// }
// print "<br><br><br>";

$date = '30-02-2020';

print "Date Validation<br>";
print "The input is : {$date}<br>";

print "Recommended format: <b>dd-mm-yyyy</b><br>";
print "---------------------------------- <br>";

try {
    if (checker::checkDate($date)) {
        print "The date is valid<br>";
    } else {
        print "The date is invalid<br>";
    }
} catch (DataException $e) {
    print "Exception: " . $e->getMessage();
}

$Client = new Client("Juan", "", "Calle 123", "123456789", 1, 25, new DateTime(), 5);

print "Client Validation<br>";

print "Recommended format: <b>dd-mm-yyyy</b><br>";
print "---------------------------------- <br>";