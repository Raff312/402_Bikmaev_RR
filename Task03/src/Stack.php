<?php

declare(strict_types=1);

namespace App;

class Stack implements StackInterface
{
    private array $arr = array();

    private function __construct(mixed ...$elements)
    {
        $this->push(...$elements);
    }

    public static function create(mixed ...$elements): Stack
    {
        return new Stack(...$elements);
    }

    public function push(mixed ...$elements): void
    {
        array_push($this->arr, ...$elements);
    }

    public function pop(): mixed
    {
        return array_pop($this->arr);
    }

    public function top(): mixed
    {
        if ($this->isEmpty()) {
            return null;
        }
        return $this->arr[$this->count() - 1];
    }

    public function isEmpty(): bool
    {
        return $this->count() == 0;
    }

    public function copy(): Stack
    {
        return Stack::create(...$this->arr);
    }

    public function __toString(): string
    {
        $result = "[";
        $arrow = "->";
        for ($i = $this->count() - 1; $i >= 0; $i--) {
            if ($i == 0) {
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
