<?php

class Checker
{

    public static function isNull($var): bool
    {
        if ($var === null) {
            return true;
        }
        return false;
    }

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



    public static function checkEmail(string $email): int
    {
        if (preg_match("/[\'\"\\\;]/", $email)) {
            return -1;
        }

        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($regex, $email)) {
            return 0;
        } else {
            return -1;
        }
    }


    public static function checkDNI(string $dni): int
    {
        $regex = '/^[0-9]{8}[A-Z]$/';
        if (preg_match($regex, $dni)) {
            return 0;
        } else {
            return -1;
        }
    }

    public static function checkISBN(string $isbn): int
    {
        $regex = '/^(\d{9}[0-9Xx]$)|(^(978|979)\d{10}$)/';
        return preg_match($regex, $isbn) ? 0 : -1;
    }


    public static function checkIpAddress($Ip): bool
    {
        $regexp = '/^\d{1,3}[.]\d{1,3}[.]\d{1,3}[.]\d{1,3}$/';

        if (preg_match($regexp, $Ip)) {
            $Ip = preg_split('/[.]/', $Ip);
            $valid = true;
            foreach ($Ip as $octet) {
                if ((int) $octet < 0 || (int) $octet > 255) {
                    $valid = false;
                    break;
                }
            }
            return $valid;
        }
        return false;
    }

    public static function checkDate(string $date)
    {
        $regexp = '/^\d{4}[-]\d{2}[-]\d{2}( \d{2}:\d{2}:\d{2})?$/';

        if (preg_match($regexp, $date)) {
            // Split date and optional time
            $parts = explode(' ', $date);
            $dateParts = explode('-', $parts[0]);

            $year = (int) $dateParts[0];
            if ($year > 2025 || $year < 1900) {
                throw new DataException("Year is out of range");
            }

            $month = (int) $dateParts[1];
            if ($month > 12 || $month < 1) {
                throw new DataException("Month is out of range");
            }

            $day = (int) $dateParts[2];
            if ($day > 31 || $day < 1) {
                throw new DataException("Day is out of range");
            }

            if (!checkdate($month, $day, $year)) {
                throw new DataException("Date is not valid, make sure the day is valid for the month");
            }

            if (isset($parts[1])) {
                // Validate time part HH:MM:SS
                $timeParts = explode(':', $parts[1]);
                if (count($timeParts) !== 3) {
                    throw new DataException("Time format is incorrect");
                }

                [$hour, $minute, $second] = $timeParts;
                if ($hour < 0 || $hour > 23) {
                    throw new DataException("Hour is out of range");
                }
                if ($minute < 0 || $minute > 59) {
                    throw new DataException("Minute is out of range");
                }
                if ($second < 0 || $second > 59) {
                    throw new DataException("Second is out of range");
                }
            }

            return true;
        } else {
            throw new DataException("Date format is incorrect");
        }
    }

}