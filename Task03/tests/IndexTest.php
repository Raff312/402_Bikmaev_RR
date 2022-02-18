<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;

use function App\checkIfBalanced;

final class IndexTest extends TestCase
{
    public function testCheckIfBalanced(): void
    {
        $this->assertSame(true, checkIfBalanced("(ab[cd{}])"));
        $this->assertSame(false, checkIfBalanced("(ab[cd{})"));
        $this->assertSame(false, checkIfBalanced("(ab[cd{]})"));
        $this->assertSame(true, checkIfBalanced("[()]{}{[()()]()}"));
        $this->assertSame(false, checkIfBalanced("[(])"));
        $this->assertSame(true, checkIfBalanced("(){}([])"));
    }
}
