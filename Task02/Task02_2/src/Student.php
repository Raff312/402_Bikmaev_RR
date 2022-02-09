<?php

declare(strict_types=1);

namespace App;

class Student
{
    private int $id;
    private string $firstName;
    private string $secondName;
    private string $faculty;
    private int $course;
    private int $group;

    private static int $counter = 1;

    private function __construct()
    {
        $this->id = self::$counter++;
    }

    public static function create(): Student
    {
        return new Student();
    }

    public function setFirstName(string $name): Student
    {
        $this->firstName = $name;
        return $this;
    }

    public function setSecondName(string $name): Student
    {
        $this->secondName = $name;
        return $this;
    }

    public function setFaculty(string $faculty): Student
    {
        $this->faculty = $faculty;
        return $this;
    }

    public function setCourse(int $course): Student
    {
        $this->course = $course;
        return $this;
    }

    public function setGroup(int $group): Student
    {
        $this->group = $group;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function getFaculty(): string
    {
        return $this->faculty;
    }

    public function getCourse(): int
    {
        return $this->course;
    }

    public function getGroup(): int
    {
        return $this->group;
    }

    public function __toString(): string
    {
        return ("Id: {$this->id}" . "\n" . "Фамилия: {$this->secondName}" . "\n" .
            "Имя: {$this->firstName}" . "\n" . "Факультет: {$this->faculty}" . "\n" .
            "Курс: {$this->course}" . "\n" . "Группа:  {$this->group}");
    }

    public static function resetCounter(): void // for test purpose
    {
        self::$counter = 1;
    }
}
