<?php
declare(strict_types=1);

class FileUtilities
{
    public static function ReadFitxer($archivo): array
    {
        $array = [];
        while (($line = fgets($archivo)) !== false) {
            $array[] = $line;
        }
        return $array;
    }

    public static function ReplaceInFile($path, $old, $new)
    {
        $array = [];
        $find = false;
        $archivo = fopen($path, "rt");
        while (($line = fgets($archivo)) !== false) {
            if (stripos($line, $old)) {
                $array[] = str_ireplace($old, $new, $line);
                $find = true;
            } else {
                $array[] = $line;
            }
        }
        fclose($archivo);
        $archivo = fopen($path, "wt");
        foreach ($array as $Linea) {
            fwrite($archivo, $Linea);
        }
        fclose($archivo);
        return $find ? 0 : -1;
    }

    public static function cipherFile($TextPath, $PasswordPath)
    {
        if (file_exists($PasswordPath)) {
            $Password = fopen($PasswordPath, "r");
            $passArray = [];
            while (($number = fgets($Password)) !== false) {
                $number = trim($number);
                $passArray[] = $number;
            }
            fclose($Password);
            if (file_exists($TextPath)) {
                $abecedario = ' abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $cadenaEncrypt = "";
                $abecedarioLength = strlen($abecedario);
                $vueltas = 0;
                $ArchivoACifrar = fopen($TextPath, "rt");
                $Cadena = "";
                while (($letter = fgets($ArchivoACifrar)) !== false) {
                    $Cadena .= $letter;
                }
                for ($i = 0; $i < strlen($Cadena); $i++) {
                    $letraPos = strpos($abecedario, $Cadena[$i]);
                    if ($letraPos === false) {
                        $cadenaEncrypt .= $Cadena[$i];
                    } else {
                        if ($vueltas == count($passArray)) {
                            $vueltas = 0;
                        }
                        $letraPos = ($letraPos + $passArray[$vueltas] + $abecedarioLength) % $abecedarioLength;
                        $cadenaEncrypt .= $abecedario[$letraPos];
                        $vueltas++;
                    }
                }
                fclose($ArchivoACifrar);
                $ArchivoACifrar = fopen($TextPath, "wt");
                fwrite($ArchivoACifrar, $cadenaEncrypt);
                fclose($ArchivoACifrar);
                return 0;
            } else {
                return -1;
            }
        } else {
            return -1;
        }
    }

    public static function UncipherFile($TextPath, $PasswordPath)
    {
        $Password = fopen($PasswordPath, "r");
        $passArray = [];
        while (($number = fgets($Password)) !== false) {
            $number = trim($number);
            $passArray[] = $number;
        }
        fclose($Password);
        if (file_exists($TextPath)) {
            $abecedario = ' abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $cadenaEncrypt = "";
            $abecedarioLength = strlen($abecedario);
            $vueltas = 0;
            $ArchivoACifrar = fopen($TextPath, "rt");
            $Cadena = "";
            while (($letter = fgets($ArchivoACifrar)) !== false) {
                $Cadena .= $letter;
            }
            for ($i = 0; $i < strlen($Cadena); $i++) {
                $letraPos = strpos($abecedario, $Cadena[$i]);
                if ($vueltas == count($passArray)) {
                    $vueltas = 0;
                }
                $letraPos = ($letraPos - $passArray[$vueltas] + $abecedarioLength) % $abecedarioLength;
                $cadenaEncrypt .= $abecedario[$letraPos];
                $vueltas++;
            }
            fclose($ArchivoACifrar);
            $ArchivoACifrar = fopen($TextPath, "wt");
            fwrite($ArchivoACifrar, $cadenaEncrypt);
            fclose($ArchivoACifrar);
            return 0;
        } else {
            return -1;
        }
    }

    public static function extractUserInactivites($path, $TimeLimit): int
    {
        $usuariosInactivos = [];
        $archivo = fopen($path, "rt");

        while (($line = fgets($archivo)) !== false) {
            $datos = explode(";", trim($line));

            if (count($datos) < 4) {
                continue;
            }

            [$usuario, $departamento, $activo, $inactivo] = $datos;

            if (empty($usuario) || empty($departamento) || empty($activo) || empty($inactivo)) {
                continue;
            }

            if ((int) $inactivo > (int) $TimeLimit) {
                $usuariosInactivos[] = $usuario;
            }
        }

        fclose($archivo);
        return count($usuariosInactivos);
    }

    public static function saveDeptInactivity($path, $ArchivoAEscribir, $departmentInput)
    {
        $usuariosDepartamento = [];
        $archivo = fopen($path, "rt");

        while (($line = fgets($archivo)) !== false) {
            $datos = explode(";", trim($line));

            if (count($datos) < 4) {
                continue;
            }

            [$usuario, $departamento, $activo, $inactivo] = $datos;

            if (empty($usuario) || empty($departamento) || empty($activo) || empty($inactivo)) {
                continue;
            }

            if ($departmentInput == "*" || $departmentInput == $departamento) {
                $usuariosDepartamento[] = "$usuario, departamento $departamento, Tiempo Inactivo: $inactivo\n";
            }
        }

        fclose($archivo);

        $ArchivoAEscribir = fopen($ArchivoAEscribir, "wt");
        foreach ($usuariosDepartamento as $usuario) {
            fwrite($ArchivoAEscribir, $usuario);
        }
        fclose($ArchivoAEscribir);

        return 0;
    }
}
