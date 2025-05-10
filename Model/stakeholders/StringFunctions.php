<?php
declare(strict_types=1);

namespace Model\Stakeholders;

class StringFunctions
{
    public static function distcar(string $Caracter1, string $Caracter2, string $Palabra): int
    {
        if (($pos1 = stripos($Palabra, $Caracter1)) !== false) {
        }
        if (($pos2 = stripos($Palabra, $Caracter2)) !== false) {
        }
        return abs($pos1 - $pos2);
    }

    public static function cleancad(string $cadena): string
    {
        $cadena = str_replace([" ", "\n", "\t"], "", $cadena);
        return $cadena;
    }

    public static function mycrypt(string $cadena): string
    {
        $arrayEncrypt = [-3, 7, -2, 5, -5, 2, -8, 4];
        $abecedario = [' ', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $cadenaEncrypt = "";
        $ii = 0;
        $abecedario = implode("", $abecedario);
        $abecedarioLength = strlen($abecedario);
        for ($i = 0; $i < strlen($cadena); $i++) {
            $letraPos = strpos($abecedario, $cadena[$i]);
            if ($ii == count($arrayEncrypt)) {
                $ii = 0;
            }
            $letraPos = ($letraPos + $arrayEncrypt[$ii] + $abecedarioLength) % $abecedarioLength;
            $cadenaEncrypt .= $abecedario[$letraPos];
            $ii++;
        }
        return $cadenaEncrypt;
    }

    public static function mydecript(string $cadena): string
    {
        $arrayEncrypt = [-3, 7, -2, 5, -5, 2, -8, 4];
        $abecedario = [' ', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $cadenaEncrypt = "";
        $ii = 0;
        $abecedario = implode("", $abecedario);
        $abecedarioLength = strlen($abecedario);
        for ($i = 0; $i < strlen($cadena); $i++) {
            $letraPos = strpos($abecedario, $cadena[$i]);
            if ($ii == count($arrayEncrypt)) {
                $ii = 0;
            }
            $letraPos = ($letraPos - $arrayEncrypt[$ii] + $abecedarioLength) % $abecedarioLength;
            $cadenaEncrypt .= $abecedario[$letraPos];
            $ii++;
        }
        return $cadenaEncrypt;
    }

    public static function ContLetras(string $cadena, string $caracter): int
    {
        $contador = 0;
        foreach (str_split($cadena) as $letra) {
            if ($letra == $caracter) {
                $contador++;
            }
        }
        return $contador;
    }

    public static function ContLetrasPosiciones(string $cadena, string $caracter): array
    {
        $cadenaArray = str_split($cadena);
        $pos = [];
        foreach ($cadenaArray as $indice => $letra) {
            if ($letra == $caracter) {
                $pos[] = $indice;
            }
        }
        return $pos;
    }

    public static function IsPol(string $palabra): void
    {
        $palabrabase = $palabra;

        $nopermitidas = ["á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ", "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”", "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã ", "Ã„", "Ã‹"];
        $permitidas = ["a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U", "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "u", "o", "O", "i", "a", "e", "U", "I", "A", "E"];
        $caracteresnopermitidos = ["!", "?", "@", "#", "$", "%", "&", "*", "(", ")", "", "+", "{", "}", "[", "]", "|", ":", ";", "'", "", "<", ">", ",", ".", "/", "~", "^", "¨", "`", "€", "£", "¥", "©", "®", "™", "§", "¶", "°", "≠", "≈", "≤", "≥", "∑", "∏"];
        $palabra = strtolower($palabra);
        $palabra = str_replace(" ", "", $palabra);
        $palabra = str_replace($caracteresnopermitidos, "", $palabra);
        $palabra = str_replace($nopermitidas, $permitidas, $palabra);
        $palindro = strrev($palabra);

        if ($palabra == $palindro) {
            print "La cadena $palabrabase es palíndromo --> $palindro";
        } else {
            print "La cadena $palabrabase no es palíndromo";
        }
    }
}