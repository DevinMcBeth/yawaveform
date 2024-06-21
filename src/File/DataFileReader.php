<?php

declare(strict_types=1);

namespace Yawaveform\File;

use Yawaveform\Exception\File\FileNotReadable;
use SplFileObject;

abstract class DataFileReader implements ReaderInterface
{
    protected const FILE_MODE = 'rb';

    protected static array $defaultContextOptions = [
        'http' => [
            'method' => 'GET',
        ],
    ];

    protected readonly bool $isRemoteFile;

    protected readonly SplFileObject $file;

    public function __construct(
        protected readonly string $filepath,
        ?resource $context = null,
    ) {
        $this->isRemoteFile = static::isRemoteFile($filepath);
        if ($this->isRemoteFile) {
            $context ??= stream_context_create(static::$defaultContextOptions);
        }

        $this->file = new SplFileObject($filepath, static::FILE_MODE, context: $context);
        if (!$this->file->isReadable()) {
            throw new FileNotReadable($this->file->getFilename());
        }

        $this->validateFile();
    }

    public static function isRemoteFile(string $filepath): bool
    {
        if (@file_exists($filepath)) {
            return false;
        }

        $httpStatus = get_headers($filepath)[0] ?? '404 Not Found';
        return str_contains($httpStatus, '200 OK');
    }

    public function getFile(): SplFileObject
    {
        return $this->file;
    }

    abstract protected function validateFile(): void;
}
