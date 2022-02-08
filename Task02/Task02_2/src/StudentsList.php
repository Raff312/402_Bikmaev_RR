<?php

declare(strict_types=1);

namespace App;

use Exception;

class StudentsList
{
    private array $students = array();

    private function __construct()
    {
    }

    public static function create(): StudentsList
    {
        return new StudentsList();
    }

    public function add(Student $student): void
    {
        array_push($this->students, $student);
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
}
