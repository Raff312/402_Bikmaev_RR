<?php

declare(strict_types=1);

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\DBLogger;
use App\Student;
use App\StudentsList;

final class DBLoggerTest extends TestCase
{
    public function tearDown(): void
    {
        if (file_exists("./logs/testLogs.db")) {
            unlink("./logs/testLogs.db");
        }

        if (file_exists("./logs")) {
            rmdir("./logs");
        }
    }

    public function testLog(): void
    {
        // arrange
        $logger = new DBLogger("./logs", "testLogs.db");

        // act
        $student1 = Student::create();
        $student2 = Student::create();

        $studentsList = StudentsList::create($logger);
        $studentsList->add($student1);
        $studentsList->add($student2);

        // assert
        $this->assertTrue(file_exists("./logs/testLogs.db"));
    }
}
