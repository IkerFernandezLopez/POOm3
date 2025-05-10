<?php
declare(strict_types=1);

class MathUtils
{
    public static function divisors(int $num): array
    {
        $divisors = [];

        if ($num > 0) {
            $divisors[] = 1;
            $divisors[] = $num;
            $maxdiv = sqrt($num);

            if ($num % 2 == 0) {
                $divisors[] = 2;
                $divisors[] = $num / 2;
                $inc = 1;
            } else {
                $inc = 2;
            }

            for ($div = 3; $div <= $maxdiv; $div += $inc) {
                if ($num % $div == 0) {
                    $divisors[] = $div;
                    if ($div != $maxdiv) {
                        $divisors[] = $num / $div;
                    }
                }
            }
            sort($divisors);
        }
        return $divisors;
    }

    public static function maxValue(int $value1, int $value2): int
    {
        return $value1 > $value2 ? $value1 : $value2;
    }

    public static function minValue(int $value1, int $value2): int
    {
        return $value1 < $value2 ? $value1 : $value2;
    }

    public static function exchange(&$value1, &$value2): void
    {
        $temp = $value1;
        $value1 = $value2;
        $value2 = $temp;
    }

    public static function resta(int $value1, int $value2, bool $positiva = false): int
    {
        if ($positiva && $value1 < $value2) {
            return $value2 - $value1;
        }
        return $value1 - $value2;
    }

    public static function isPrime(int $num): bool
    {
        if ($num < 2) {
            return false;
        }
        for ($div = 2; $div <= sqrt($num); $div++) {
            if ($num % $div == 0) {
                return false;
            }
        }
        return true;
    }

    public static function isPerfect(int $num): bool
    {
        $sum = 0;
        for ($i = 1; $i <= $num / 2; $i++) {
            if ($num % $i == 0) {
                $sum += $i;
            }
        }
        return $sum == $num;
    }

    public static function MCD(int $num1, int $num2): int
    {
        $major = self::maxValue($num1, $num2);
        $MCD = 1;
        for ($i = 1; $i <= $major; $i++) {
            if ($num1 % $i == 0 && $num2 % $i == 0) {
                $MCD = $i;
            }
        }
        return $MCD;
    }

    public static function MCM(int $num1, int $num2): int
    {
        $major = self::maxValue($num1, $num2);
        for ($i = $major; $i <= $num1 * $num2; $i++) {
            if ($i % $num1 == 0 && $i % $num2 == 0) {
                return $i;
            }
        }
        return $num1 * $num2;
    }

    public static function fibo(int $num): array
    {
        $numantiguo = 0;
        $numnuevo = 1;
        $fibo = [];
        for ($i = 1; $i <= $num; $i++) {
            $fibo[] = $numnuevo;
            $temp = $numantiguo;
            $numantiguo = $numnuevo;
            $numnuevo = $numantiguo + $temp;
        }
        return $fibo;
    }

    public static function printArray(array $array, string $separador): void
    {
        foreach ($array as $value) {
            print $value . " $separador ";
        }
    }

    public static function printArrayAsoc(array $array, string $separador1, string $separador2): void
    {
        foreach ($array as $campo => $valor) {
            print "{$campo}{$separador1}{$valor}{$separador2}";
        }
    }

    public static function fillArray(int $num1, int $num2, int $longitudArray): array
    {
        if ($num1 > $num2) {
            self::exchange($num1, $num2);
        }
        $array = [];
        for ($i = 0; $i < $longitudArray; $i++) {
            $array[] = rand($num1, $num2);
        }
        return $array;
    }

    public static function StatsArray(array $array, &$max, &$min, &$mitja): void
    {
        $max = max($array);
        $min = min($array);
        $mitja = array_sum($array) / count($array);
    }

    public static function ArraySort(array &$array, string $orden): void
    {
        if ($orden === 'asc') {
            sort($array);
        } elseif ($orden === 'desc') {
            rsort($array);
        }
    }

    public static function linSearch(array $array, $numero): int
    {
        foreach ($array as $index => $value) {
            if ($value == $numero) {
                return $index;
            }
        }
        return -1;
    }

    public static function linSearchALL(array $array, $numero): array
    {
        $indices = [];
        foreach ($array as $index => $value) {
            if ($value == $numero) {
                $indices[] = $index;
            }
        }
        return $indices ?: ["No se han encontrado numeros"];
    }

    public static function binSearch(array $array, $numero): float|int
    {
        $min = 0;
        $max = count($array) - 1;
        while ($min <= $max) {
            $mitja = floor(($min + $max) / 2);
            if ($array[$mitja] == $numero) {
                return $mitja;
            }
            if ($array[$mitja] < $numero) {
                $min = $mitja + 1;
            } else {
                $max = $mitja - 1;
            }
        }
        return -1;
    }
}
