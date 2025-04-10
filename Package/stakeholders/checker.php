<?php

class Checker
{

    //----------------------------------GENERAL----------------------------------
    public static function isNull($var): bool
    {
        if ($var === null) {
            return true;
        }
        return false;
    }

    //----------------------------------STRINGS----------------------------------
    public static function isEmpty($var): bool
    {
        if (trim($var) === "") {
            return true;
        }
        return false;
    }

    public static function isShort(string $var, int $min): bool
    {
        if (strlen(trim($var)) < $min) {
            return true;
        }
        return false;
    }

    public static function checkString(string $var, int $min): int
    {
        if (self::isNull($var)) {
            return -1;
        }
        if (self::isEmpty($var)) {
            return -2;
        }
        if (self::isShort($var, $min)) {
            return -3;
        }
        return 0;
    }

    public static function getErrorMessage(int $error): string
    {
        return match ($error) {
            -1 => "Is null",
            -2 => "Is empty",
            -3 => "Is too short",
            default => "Unknown error",
        };
    }

    //----------------------------------INTEGERS----------------------------------
    public static function isEmptyInt(int $var): bool
    {
        return $var === 0;
    }

    public static function isShortInt(int $var, int $min): bool
    {
        return $var < $min;
    }

    public static function checkInt(int $var, int $min): int
    {
        if (self::isNull($var)) {
            return -1;
        }
        if (self::isEmptyInt($var)) {
            return -2;
        }
        if (self::isShortInt($var, $min)) {
            return -3;
        }
        return 0;
    }

    //----------------------------------ARRAY----------------------------------
    public static function isEmptyArray(array $var): bool
    {
        return count($var) === 0;
    }

    public static function isShortArray(array $var, int $min): bool
    {
        return count($var) < $min;
    }

    public static function checkArray(array $var, int $min): int
    {
        if (self::isNull($var)) {
            return -1;
        }
        if (self::isEmptyArray($var)) {
            return -2;
        }
        if (self::isShortArray($var, $min)) {
            return -3;
        }
        return 0;
    }

    //----------------------------------BOOL----------------------------------
    public static function isEmptyBool(bool $var): bool
    {
        return $var === false;
    }

    public static function checkBool(bool $var): int
    {
        if (self::isNull($var)) {
            return -1;
        }
        if (self::isEmptyBool($var)) {
            return -2;
        }
        return 0;
    }
}