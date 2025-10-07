<?php

namespace App\Storage;
class JsonFileHandler
{
    protected string $filePath;

    public function __construct(string $table, JsonDbConnection $dbManager)
    {
        $this->filePath = $dbManager->getPath($table);

        // Se till att filen finns
        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
    }

    public function read(): array
    {
        $content = file_get_contents($this->filePath);
        return json_decode($content, true) ?? [];
    }

    public function write(array $data)
    {
        file_put_contents($this->filePath,
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}

    
