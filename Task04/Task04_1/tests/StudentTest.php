<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Student;

final class StudentTest extends TestCase
{
    public function testGetters(): void
    {
        // arrange
        $student1 = Student::create();
        $student2 = Student::create();
        $student3 = Student::create();

        // act
        $student3->setFirstName("Сергей")->setSecondName("Иванов")->setFaculty("ФМиИТ")->setCourse(4)->setGroup(402)->__toString();

        // assert
        $this->assertSame(3, $student3->getId());
        $this->assertSame("Сергей", $student3->getFirstName());
        $this->assertSame("Иванов", $student3->getSecondName());
        $this->assertSame("ФМиИТ", $student3->getFaculty());
        $this->assertSame(4, $student3->getCourse());
        $this->assertSame(402, $student3->getGroup());
    }
}
