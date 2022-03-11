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

    public function testCurrent(): void
    {
        // arrange
        $student1 = Student::create();
        $student1->setFirstName("Сергей1")->setSecondName("Иванов1")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student2 = Student::create();
        $student2->setFirstName("Сергей2")->setSecondName("Иванов2")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student3 = Student::create();
        $student3->setFirstName("Сергей3")->setSecondName("Иванов3")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);

        $studentsList = StudentsList::create();
        $studentsList->add($student1);
        $studentsList->add($student2);
        $studentsList->add($student3);

        // act
        $currentStudent = $studentsList->current();

        // assert
        $this->assertSame(1, $currentStudent->getId());
        $this->assertSame("Сергей1", $currentStudent->getFirstName());
        $this->assertSame("Иванов1", $currentStudent->getSecondName());
        $this->assertSame("ФМиИТ", $currentStudent->getFaculty());
        $this->assertSame(4, $currentStudent->getCourse());
        $this->assertSame(402, $currentStudent->getGroup());
    }
    
    public function testKey(): void
    {
        // arrange
        $student1 = Student::create();
        $student1->setFirstName("Сергей1")->setSecondName("Иванов1")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student2 = Student::create();
        $student2->setFirstName("Сергей2")->setSecondName("Иванов2")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student3 = Student::create();
        $student3->setFirstName("Сергей3")->setSecondName("Иванов3")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);

        $studentsList = StudentsList::create();
        $studentsList->add($student1);
        $studentsList->add($student2);
        $studentsList->add($student3);

        // act
        $currentStudentKey = $studentsList->key();

        // assert
        $this->assertSame(1, $currentStudentKey);
    }
    
    public function testNext(): void
    {
        // arrange
        $student1 = Student::create();
        $student1->setFirstName("Сергей1")->setSecondName("Иванов1")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student2 = Student::create();
        $student2->setFirstName("Сергей2")->setSecondName("Иванов2")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student3 = Student::create();
        $student3->setFirstName("Сергей3")->setSecondName("Иванов3")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);

        $studentsList = StudentsList::create();
        $studentsList->add($student1);
        $studentsList->add($student2);
        $studentsList->add($student3);

        // act
        $studentsList->next();
        $studentsList->next();
        $currentStudent1 = $studentsList->current();
        $studentsList->next();
        $studentsList->next();
        $currentStudent2 = $studentsList->current();

        // assert
        $this->assertSame(3, $currentStudent1->getId());
        $this->assertSame(false, $currentStudent2);
    }
    
    public function testRewind(): void
    {
        // arrange
        $student1 = Student::create();
        $student1->setFirstName("Сергей1")->setSecondName("Иванов1")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student2 = Student::create();
        $student2->setFirstName("Сергей2")->setSecondName("Иванов2")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student3 = Student::create();
        $student3->setFirstName("Сергей3")->setSecondName("Иванов3")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);

        $studentsList = StudentsList::create();
        $studentsList->add($student1);
        $studentsList->add($student2);
        $studentsList->add($student3);

        // act
        $studentsList->next();
        $studentsList->next();
        $studentsList->rewind();
        $currentStudent = $studentsList->current();

        // assert
        $this->assertSame(1, $currentStudent->getId());
    }
    
    public function testValid(): void
    {
        // arrange
        $student1 = Student::create();
        $student1->setFirstName("Сергей1")->setSecondName("Иванов1")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student2 = Student::create();
        $student2->setFirstName("Сергей2")->setSecondName("Иванов2")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);
        $student3 = Student::create();
        $student3->setFirstName("Сергей3")->setSecondName("Иванов3")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402);

        $studentsList = StudentsList::create();
        $studentsList->add($student1);
        $studentsList->add($student2);
        $studentsList->add($student3);

        // act
        $studentsList->next();
        $studentsList->next();
        $valid1 = $studentsList->valid();
        $studentsList->next();
        $studentsList->next();
        $valid2 = $studentsList->valid();

        // assert
        $this->assertSame(true, $valid1);
        $this->assertSame(false, $valid2);
    }
}
