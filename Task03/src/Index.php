<?php

declare(strict_types=1);

namespace App;

use App\Stack;

function checkIfBalanced(string $expression): bool
{
    $stack = Stack::create();

    for ($i = 0; $i < strlen($expression); $i++) {
        $ch = $expression[$i];

        if ($ch === "(" || $ch === "[" || $ch === "{" || $ch === "<") {
            $stack->push($ch);
        }

        if ($ch === ")" || $ch === "]" || $ch === "}" || $ch === ">") {
            if ($stack->isEmpty()) {
                return false;
            } elseif (!isMachingPair($stack->pop(), $ch)) {
                return false;
            }
        }
    }

    return $stack->isEmpty();
}

function isMachingPair(string $s1, string $s2): bool
{
    if ($s1 === "(" && $s2 === ")") {
        return true;
    } elseif ($s1 === "{" && $s2 === "}") {
        return true;
    } elseif ($s1 === "[" && $s2 === "]") {
        return true;
    } elseif ($s1 === "<" && $s2 === ">") {
        return true;
    } else {
        return false;
    }
}
