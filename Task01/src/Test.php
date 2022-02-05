<?php

namespace App\Test;

use App\Fraction;
use Exception;

function runTest()
{
    $m1 = Fraction::create(34, 116);
    echo "Actual result: " . $m1 . "\n";
    echo "Expected result: 17/58\n\n";

    $m1_1 = Fraction::create(34, -116);
    echo "Actual result: " . $m1_1 . "\n";
    echo "Expected result: -17/58\n\n";

    $m1_2 = Fraction::create(-34, 116);
    echo "Actual result: " . $m1_2 . "\n";
    echo "Expected result: -17/58\n\n";

    $m1_3 = Fraction::create(-34, -116);
    echo "Actual result: " . $m1_3 . "\n";
    echo "Expected result: 17/58\n\n";

    $m1_4 = Fraction::create(0, -116);
    echo "Actual result: " . $m1_4 . "\n";
    echo "Expected result: 0\n\n";

    $m1_5 = Fraction::create(10, 5);
    echo "Actual result: " . $m1_5 . "\n";
    echo "Expected result: 2\n\n";

    $m2 = Fraction::create(343, 54);
    echo "Actual result: " . $m2 . "\n";
    echo "Expected result: 6'19/54\n\n";

    try {
        $m2_1 = Fraction::create(343, 0);
    } catch (Exception $e) {
        echo "Actual result: " . $e->getMessage() . "\n";
        echo "Expected result: denominator can't be 0\n\n";
    }

    $m3 = Fraction::create(595, 721);
    echo "Actual result: " . $m3->getNumer() . "/" . $m3->getDenom() . "\n";
    echo "Expected result: 85/103\n\n";

    $m4 = $m1->add($m2);
    echo "Actual result: " . $m4 . "\n";
    echo "Expected result: 6'505/783\n\n";

    $m6 = $m4->sub($m1);
    echo "Actual result: " . $m6 . "\n";
    echo "Expected result: " . $m2 . "\n\n";

    $m7 = $m6->sub($m2);
    echo "Actual result: " . $m7 . "\n";
    echo "Expected result: 0\n\n";

    $m8 = $m7->sub($m1);
    echo "Actual result: " . $m8 . "\n";
    echo "Expected result: -17/58\n\n";
}
