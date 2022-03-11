<?php

declare(strict_types=1);

namespace App;

class Truncater
{
    private static array $defaultOptions = array("separator" => "...", "length" => 100);

    private $options = array();

    private function __construct(array $options = null)
    {
        if ($options) {
            $this->options = $options + self::$defaultOptions;
        } else {
            $this->options = self::$defaultOptions;
        }
    }

    public static function create(array $options = null): Truncater
    {
        return new Truncater($options);
    }

    public function truncate(string $str, array $options = null): string
    {
        if ($options) {
            $options = $options + $this->options;
        } else {
            $options = $this->options;
        }

        if (strlen($str) <= $options["length"]) {
            return $str;
        }

        return substr($str, 0, $options["length"]) . $options["separator"];
    }
}
