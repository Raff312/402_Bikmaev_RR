<?php

declare(strict_types=1);

namespace App;

class Queue implements QueueInterface
{
    private array $arr = array();

    private function __construct(mixed ...$elements)
    {
        $this->enqueue(...$elements);
    }

    public static function create(mixed ...$elements): Queue
    {
        return new Queue(...$elements);
    }

    public function enqueue(mixed ...$elements): void
    {
        array_push($this->arr, ...$elements);
    }

    public function dequeue(): mixed
    {
        return array_shift($this->arr);
    }

    public function peek(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->arr[0];
    }

    public function isEmpty(): bool
    {
        return $this->count() == 0;
    }

    public function copy(): Queue
    {
        return new Queue(...$this->arr);
    }

    public function __toString(): string
    {
        $result = "[";
        $arrow = "<-";
        for ($i = 0; $i < $this->count(); $i++) {
            if ($i == $this->count() - 1) {
                $arrow = "";
            }
            $result .= $this->arr[$i] . $arrow;
        }
        return $result . "]";
    }

    public function count(): int
    {
        return count($this->arr);
    }
}
