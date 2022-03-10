<?php

declare(strict_types=1);

namespace App\Tests;

use App\Stack;
use PHPUnit\Framework\TestCase;

final class StackTest extends TestCase
{
    public function testIsEmptyWithEmptyStack(): void
    {
        // arrange
        $stack = Stack::create();

        // act

        // assert
        $this->assertEquals(true, $stack->isEmpty());
    }

    public function testIsEmptyWithNotEmptyStack(): void
    {
        // arrange
        $stack = Stack::create(1, 2);

        // act

        // assert
        $this->assertEquals(false, $stack->isEmpty());
    }

    public function testCount(): void
    {
        // arrange
        $stack1 = Stack::create(1, 2, "test");
        $stack2 = Stack::create();

        // act

        // assert
        $this->assertEquals(3, $stack1->count());
        $this->assertEquals(0, $stack2->count());
    }

    public function testPush(): void
    {
        // arrange
        $stack = Stack::create();

        // act
        $stack->push(3, 1, 2);
        $stack->push(5);

        // assert
        $this->assertEquals(false, $stack->isEmpty());
        $this->assertEquals(4, $stack->count());
    }

    public function testPop(): void
    {
        // arrange
        $stack = Stack::create();

        // act
        $stack->push(3, 1, 2);
        $stack->push(5);

        // assert
        $this->assertEquals(5, $stack->pop());
        $this->assertEquals(2, $stack->pop());
        $this->assertEquals(1, $stack->pop());
        $this->assertEquals(3, $stack->pop());
        $this->assertEquals(null, $stack->pop());

        $this->assertEquals(true, $stack->isEmpty());
    }

    public function testTop(): void
    {
        // arrange
        $stack = Stack::create();

        // act
        $stack->push(3, 1, 2);

        // assert
        $this->assertEquals(2, $stack->top());
        $this->assertEquals(false, $stack->isEmpty());
        $this->assertEquals(3, $stack->count());
    }

    public function testTopEmptyStack(): void
    {
        // arrange
        $stack = Stack::create();

        // act

        // assert
        $this->assertEquals(null, $stack->top());
        $this->assertEquals(true, $stack->isEmpty());
    }

    public function testCopy(): void
    {
        // arrange
        $stack = Stack::create(1, 3);

        // act
        $copyStack = $stack->copy();
        $stack->pop();
        $copyStack->push(2);

        // assert
        $this->assertEquals(3, $copyStack->count());
        $this->assertEquals(2, $copyStack->pop());
        $this->assertEquals(3, $copyStack->pop());
        $this->assertEquals(1, $copyStack->pop());
        $this->assertEquals(true, $copyStack->isEmpty());
    }

    public function testToString(): void
    {
        // arrange
        $stack = Stack::create(1, 3, 2, "hi");

        // act

        // assert
        $this->assertEquals("[hi->2->3->1]", $stack->__toString());
    }
}
