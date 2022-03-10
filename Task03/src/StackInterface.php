<?php

declare(strict_types=1);

namespace App;

interface StackInterface
{
    public function push(mixed ...$elements): void;
    public function pop(): mixed;
    public function top(): mixed;
    public function isEmpty(): bool;
    public function copy(): Stack;
    public function count(): int;
    public function __toString(): string;
}
