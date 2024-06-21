<?php

declare(strict_types=1);

namespace Yawaveform\Exception\File;

use InvalidArguementException;

class FileNotReadable extends InvalidArguementException
{
    private const MESSAGE_FORMAT = 'The file %s is not readable.';

    public function __construct(
        private readonly string $filename,
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        $message = sprintf(static::MESSAGE_FORMAT, $filename);
        parent::__construct($message, $code, $previous);
    }

    final public function getFilename(): string
    {
        return $this->filename;
    }
}
