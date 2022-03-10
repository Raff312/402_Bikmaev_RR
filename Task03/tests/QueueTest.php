<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Queue;

final class QueueTest extends TestCase
{
    public function testIsEmptyWithEmptyQueue(): void
    {
        // arrange
        $queue = Queue::create();

        // act

        // assert
        $this->assertEquals(true, $queue->isEmpty());
    }

    public function testIsEmptyWithNotEmptyQueue(): void
    {
        // arrange
        $queue = Queue::create(2, "3");

        // act

        // assert
        $this->assertEquals(false, $queue->isEmpty());
    }

    public function testCount(): void
    {
        // arrange
        $queue1 = Queue::create(1, "test");
        $queue2 = Queue::create();

        // act

        // assert
        $this->assertEquals(2, $queue1->count());
        $this->assertEquals(0, $queue2->count());
    }

    public function testEnqueue(): void
    {
        // arrange
        $queue = Queue::create();

        // act
        $queue->enqueue("3", 4, false);
        $queue->enqueue(10);

        // assert
        $this->assertEquals(false, $queue->isEmpty());
        $this->assertEquals(4, $queue->count());
    }

    public function testDequeue(): void
    {
        // arrange
        $queue = Queue::create();

        // act
        $queue->enqueue("3", 4, false);
        $queue->enqueue(10);

        // assert
        $this->assertEquals("3", $queue->dequeue());
        $this->assertEquals(4, $queue->dequeue());
        $this->assertEquals(false, $queue->dequeue());
        $this->assertEquals(10, $queue->dequeue());
        $this->assertEquals(null, $queue->dequeue());

        $this->assertEquals(true, $queue->isEmpty());
    }

    public function testPeek(): void
    {
        // arrange
        $queue = Queue::create();

        // act
        $queue->enqueue("3", 4, false);

        // assert
        $this->assertEquals("3", $queue->peek());
        $this->assertEquals(false, $queue->isEmpty());
        $this->assertEquals(3, $queue->count());
    }

    public function testPeekEmptyQueue(): void
    {
        // arrange
        $queue = Queue::create();

        // act

        // assert
        $this->assertEquals(null, $queue->peek());
        $this->assertEquals(true, $queue->isEmpty());
    }

    public function testCopy(): void
    {
        // arrange
        $queue = Queue::create(1, "3");

        // act
        $copyQueue = $queue->copy();
        $queue->dequeue();
        $copyQueue->enqueue(2);

        // assert
        $this->assertEquals(3, $copyQueue->count());
        $this->assertEquals(1, $copyQueue->dequeue());
        $this->assertEquals("3", $copyQueue->dequeue());
        $this->assertEquals(2, $copyQueue->dequeue());
        $this->assertEquals(true, $copyQueue->isEmpty());
    }

    public function testToString(): void
    {
        // arrange
        $queue = Queue::create(1, 3, 2, "hi");

        // act

        // assert
        $this->assertEquals("[1<-3<-2<-hi]", $queue->__toString());
    }
}
