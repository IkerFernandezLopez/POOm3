<?php

/*
Las interfaces son una forma de definir un contrato que las clases deben cumplir, es decir,
abres funciones pero las dejas para que se rellenen dentro de las clases,
en este caso, estoy abriendo estas 4,
y su contenido va a ser distinto en una clase que en otra,
pero el nombre de la funcion y el tipo de dato que devuelve es el mismo,
por lo que se puede usar en cualquier parte del programa sin importar la clase que lo use.
*/

// Hay un ejemplo en el archivo CompanyClient.php
interface Stakeholders
{
    public function getCode(): string;
    public function getPrice(): int|float;
    public function getData(): string;
    public function getDetails(): string;

}