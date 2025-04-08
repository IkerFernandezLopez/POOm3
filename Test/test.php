<?php
include_once '../Model/stakeholders/Client.php';
include_once '../Model/stakeholders/Worker.php';
include_once '../Model/stakeholders/Company.php';
include_once '../Model/stakeholders/Provider.php';
include_once '../Model/stakeholders/CompanyProvider.php';
include_once '../Model/stakeholders/CompanyClient.php';

print "<b>Cliente</b><br>";
$testClient = new Client('Juan', 'zesxrdcfvygbuhnijmo', '.ñl,pkmjonihbugvyfcdtrse', 12345678, 12345678, 30, 'VIP', 10);
print $testClient->getContactData();
print "<br><br>";

print "<b>Proovedor</b><br>";
$testProvider = new Provider('Pedro', 'zesxrdcfvygbuhnijmo', '.ñl,pkmjonihbugvyfcdtrse', 12345678, 12345678, 30, 'Producto', '12/12/2021');
print $testProvider->getContactData();
print "<br><br>";

print "<b>Trabajador</b><br>";
$testWorker = new Worker('carlos', 'grsesfsreefef', 'jitigrgbguernege', 83759283, 3, 60, 'maquinista', 1000);
print $testWorker->getContactData();
print "<br><br>";

print "<b>Empresa</b><br>";
$testCompany = new Comp('supperpepe', 'poiuytre');
print "Company Name: ";
print $testCompany->getCompanyName();
print "<br>";
print "Company Type: ";
print $testCompany->getCompanyType();

print "<br><br>";
print "<b>Proovedor</b><br>";
$testProvider = new Provider('Pedro', 'zesxrdcfvygbuhnijmo', '.ñl,pkmjonihbugvyfcdtrse', 12345678, 12345678, 30, 'Producto', '12/12/2021');
print $testProvider->getContactData();
print "<br><br>";

print "<br><br>";
print "<b>CompanyProovedor</b><br>";
$testProvider1 = new CompanyProvider('Pedro', 'zesxrdcfvygbuhnijmo', '.ñl,pkmjonihbugvyfcdtrse', 12345678, 12345678, 2021, 'Producto', '12/12/2021', 'EMPRESA');
print $testProvider1->getContactData();
print "<br><br>";

print "<br><br>";
print "<b>CompanyClient</b><br>";
$testClient1 = new CompanyClient('Juan', 'zesxrdcfvygbuhnijmo', '.ñl,pkmjonihbugvyfcdtrse', 12345678, 12345678, 2021, 'VIP', 10, 'EMPRESA');
print $testClient1->getContactData();
print "<br><br>";

print "<br><br>";
print "<b>CompanyClient</b><br>";
$testClient1 = new CompanyClient('Juan', 'zesxrdcfvygbuhnijmo', '.ñl,pkmjonihbugvyfcdtrse', 12345678, 12345678, 2021, 'VIP', 10, 'EMPRESA');
print $testClient1->getContactData();
print "<br><br>";