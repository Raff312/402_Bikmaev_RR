<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\FileLogger;
use App\Student;
use App\StudentsList;

final class FileLoggerTest extends TestCase
{
    public function tearDown(): void
    {
        if (file_exists("./logs/testLogs.txt")) {
            unlink("./logs/testLogs.txt");
        }

        if (file_exists("./logs")) {
            rmdir("./logs");
        }
    }

    public function testLog(): void
    {
        // arrange
        $logger = new FileLogger("./logs", "testLogs.txt");

        // act
        $student1 = Student::create();
        $student2 = Student::create();

        $studentsList = StudentsList::create($logger);
        $studentsList->add($student1);
        $studentsList->add($student2);

        // assert
        $this->assertTrue(file_exists("./logs/testLogs.txt"));
        $this->assertSame(3, sizeof(file("./logs/testLogs.txt")));
    }
}
