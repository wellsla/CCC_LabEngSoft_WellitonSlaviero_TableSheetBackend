<?php

namespace App\Traits;

trait TransformsFileUrls
{
    /**
     * Transform storage URL to API URL
     */
    protected function transformUrlForDatabase(string $url): string
    {
        return str_replace('/storage/', '/api/', $url);
    }

    /**
     * Transform URL field in data array if it exists
     */
    protected function transformUrlFieldInData(array $data, string $field): array
    {
        if (isset($data[$field]) && is_string($data[$field])) {
            $data[$field] = $this->transformUrlForDatabase($data[$field]);
        }

        return $data;
    }
}
