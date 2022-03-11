<?php

declare(strict_types=1);

namespace App;

use SQLite3;

class DBLogger extends Logger
{
    public function log(string $date, string $time, string $description): void
    {
        $db = $this->connectToDB();
        $db->exec("INSERT INTO logs (logDate, logTime, logDescription) VALUES ('$date','$time','$description')");
    }

    private function connectToDB(): SQLite3
    {
        if (!file_exists($this->fileDir)) {
            mkdir($this->fileDir, 0777, true);
        }

        if (!file_exists($this->fileDir . "/" . $this->fileName)) {
            $db = new SQLite3($this->fileDir . "/" . $this->fileName);
            $db->exec("CREATE TABLE logs(logDate DATE, logTime TIME, logDescription TEXT)");
        } else {
            $db = new SQLite3($this->fileDir . "/" . $this->fileName);
        }

        return $db;
    }
}
