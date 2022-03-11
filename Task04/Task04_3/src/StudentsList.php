<?php

declare(strict_types=1);

namespace App;

use Exception;
use Iterator;

class StudentsList implements Iterator
{
    private array $students = array();
    private Logger $logger;

    private function __construct(Logger $logger)
    {
        $this->logger = $logger;
        $this->logger->log(date("d.m.Y"), date("H:i:s"), "Created a new list of students");
    }

    public static function create(Logger $logger): StudentsList
    {
        return new StudentsList($logger);
    }

    public function add(Student $student): void
    {
        array_push($this->students, $student);
        $this->logger->log(date("d.m.Y"), date("H:i:s"), "A new student has been added to the list");
    }

    public function count(): int
    {
        return count($this->students);
    }

    public function get(int $index): Student
    {
        if ($index <= 0 || $index > count($this->students)) {
            throw new Exception("index out of bound");
        }

        return $this->students[$index - 1];
    }

    public function store(string $fileName): void
    {
        if (strlen($fileName) > 0) {
            file_put_contents($fileName, serialize($this->students));
        }
    }

    public function load(string $fileName): void
    {
        if (!file_exists($fileName)) {
            throw new Exception("File {$fileName} does not exists");
        }

        $this->students = unserialize(file_get_contents($fileName));
    }

    public function current(): Student | false
    {
        return current($this->students);
    }

    public function key(): int
    {
        return current($this->students)->getId();
    }

    public function next(): void
    {
        next($this->students);
    }

    public function rewind(): void
    {
        reset($this->students);
    }

    public function valid(): bool
    {
        return $this->current() !== false;
    }
}
