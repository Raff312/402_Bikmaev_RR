<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use Exception;
use App\Student;
use App\StudentsList;

final class StudentsListTest extends TestCase
{
    public function setUp(): void
    {
        Student::resetCounter();
    }

    public function tearDown(): void
    {
        if (file_exists("text.txt")) {
            unlink("text.txt");
        }
    }

    public function testAddAndCount(): void
    {
        // arrange
        $studentsList = StudentsList::create();

        // act
        $studentsList->add(Student::create());
        $studentsList->add(Student::create());
        $studentsList->add(Student::create());

        // assert
        $this->assertSame(3, $studentsList->count());
    }

    public function testGet(): void
    {
        // arrange
        $student = Student::create();
        $student->setFirstName("Сергей")->setSecondName("Иванов")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);

        $studentsList = StudentsList::create();
        $studentsList->add($student);

        // act
        $gettedStudent = $studentsList->get(1);

        // assert
        $this->assertSame(1, $gettedStudent->getId());
        $this->assertSame("Сергей", $gettedStudent->getFirstName());
        $this->assertSame("Иванов", $gettedStudent->getSecondName());
        $this->assertSame("ФМиИТ", $gettedStudent->getFaculty());
        $this->assertSame(4, $gettedStudent->getCourse());
        $this->assertSame(402, $gettedStudent->getGroup());
    }

    public function testGet_IndexGreaterThanMax(): void
    {
        // arrange
        $studentsList = StudentsList::create();
        $studentsList->add(Student::create());

        // assert
        $this->expectException(Exception::class);
        $this->expectErrorMessage("index out of bound");

        // act
        $studentsList->get(2);
    }

    public function testGet_IndexLessThanMin(): void
    {
        // arrange
        $studentsList = StudentsList::create();
        $studentsList->add(Student::create());

        // assert
        $this->expectException(Exception::class);
        $this->expectErrorMessage("index out of bound");

        // act
        $studentsList->get(0);
    }

    public function testStore(): void
    {
        // arrange
        $studentsList = StudentsList::create();

        // act
        $studentsList->store("text.txt");

        // assert
        $this->assertFileExists("text.txt");
    }

    public function testLoad(): void
    {
        // arrange
        $student = Student::create();
        $student->setFirstName("Сергей")->setSecondName("Иванов")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $studentsList = StudentsList::create();
        $studentsList->add($student);
        $studentsList->store("text.txt");

        // act
        $studentsList->load("text.txt");

        // assert
        $gettedStudent = $studentsList->get(1);
        $this->assertSame(1, $gettedStudent->getId());
        $this->assertSame("Сергей", $gettedStudent->getFirstName());
        $this->assertSame("Иванов", $gettedStudent->getSecondName());
        $this->assertSame("ФМиИТ", $gettedStudent->getFaculty());
        $this->assertSame(4, $gettedStudent->getCourse());
        $this->assertSame(402, $gettedStudent->getGroup());
    }

    public function testLoad_FileDoesNotExists(): void
    {
        // arrange
        $studentsList = StudentsList::create();

        // assert
        $this->expectException(Exception::class);
        $this->expectErrorMessage("File text1.txt does not exists");

        // act
        $studentsList->load("text1.txt");
    }
}
