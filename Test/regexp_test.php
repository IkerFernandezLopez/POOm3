<?php

include_once '../Model/checker.php';
$ip = '211.111.211.111';

if (checker::checkIpAddress($ip)) {
    print $ip . " is Valid IP address";
} else {
    print "Invalid IP address";
}

$date = '2023-10-01';