<?php

declare(strict_types=1);

namespace App;

use Exception;

class Fraction
{
    private int $numerator;
    private int $denominator;

    private function __construct(int $numerator, int $denominator)
    {
        if (!is_int($numerator) || !is_int($denominator)) {
            throw new Exception("numerator and denominator must be integer values");
        }

        if ($denominator === 0) {
            throw new Exception("denominator can't be 0");
        }

        $sign = $this->sign($numerator * $denominator);
        $this->numerator = $sign * abs($numerator);
        $this->denominator = abs($denominator);
        $this->normalize();
    }

    private function sign(int $num): int
    {
        return ($num > 0) - ($num < 0);
    }

    private function normalize(): void
    {
        $gcd = $this->gcd($this->numerator, $this->denominator);
        if ($gcd > 1) {
            $this->numerator = $this->numerator / $gcd;
            $this->denominator = $this->denominator / $gcd;
        }
    }

    private function gcd(int $a, int $b): int
    {
        if ($a < $b) {
            $this->swap($a, $b);
        }

        while ($b != 0) {
            $r = $a % $b;
            $a = $b;
            $b = $r;
        }

        return $a;
    }

    private function swap(int &$x, int &$y): void
    {
        $tmp = $x;
        $x = $y;
        $y = $tmp;
    }

    public static function create(int $numerator, int $denominator): Fraction
    {
        return new Fraction($numerator, $denominator);
    }

    public function getNumer(): int
    {
        return $this->numerator;
    }

    public function getDenom(): int
    {
        return $this->denominator;
    }

    public function add(Fraction $fraction): Fraction
    {
        $fracNumerator = $fraction->getNumer();
        $fracDenom = $fraction->getDenom();
        $numerator = $fracDenom * $this->numerator + $this->denominator * $fracNumerator;
        $denominator = $this->denominator * $fracDenom;
        return new Fraction($numerator, $denominator);
    }

    public function sub(Fraction $fraction): Fraction
    {
        $fracNumerator = $fraction->getNumer();
        $fracDenom = $fraction->getDenom();
        $numerator = $fracDenom * $this->numerator - $this->denominator * $fracNumerator;
        $denominator = $this->denominator * $fracDenom;
        return new Fraction($numerator, $denominator);
    }

    public function __toString(): string
    {
        if ($this->numerator === 0) {
            return "0";
        } elseif (abs($this->numerator) < $this->denominator) {
            return $this->numerator . "/" . $this->denominator;
        }

        $wholePart = intval($this->numerator / $this->denominator);
        $numerator = abs($this->numerator % $this->denominator);
        if ($numerator === 0) {
            return strval($wholePart);
        }

        return $wholePart . "'" . $numerator . "/" . $this->denominator;
    }
}
