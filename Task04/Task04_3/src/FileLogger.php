<?php

declare(strict_types=1);

namespace App;

class FileLogger extends Logger
{
    public function log(string $date, string $time, string $description): void
    {
        if (!file_exists($this->fileDir)) {
            mkdir($this->fileDir, 0777, true);
        }

        $file = fopen($this->fileDir . "/" . $this->fileName, "a") or die("Failed to open file");
        fwrite($file, $date . " | " . $time . " | " . $description . PHP_EOL);
        fclose($file);
    }
}
