<?php declare(strict_types=1);

final class FileNameRetriever
{
    private string $renameFile = '';

    public function filter(array $formData): array
    {
        $formFilterValues = array_values(array_filter($formData, static function($key) {
            return str_ends_with($key, '_file');
        }, ARRAY_FILTER_USE_KEY));

        if ($formFilterValues) {
            $this->renameFile = current($formFilterValues);
        }

        return $formData;
    }

    public function getRenameFile(): string
    {
        return $this->renameFile;
    }
}
