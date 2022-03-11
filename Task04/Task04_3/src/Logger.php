<?php

declare(strict_types=1);

namespace App;

abstract class Logger
{
    protected string $fileDir;
    protected string $fileName;

    public function __construct(string $fileDir, string $fileName)
    {
        $this->fileDir = $fileDir;
        $this->fileName = $fileName;
    }

    abstract public function log(string $date, string $time, string $description);
}
