<?php

declare(strict_types=1);

namespace Yawaveform\File;

use Yawaveform\Exception\File\FileNotReadable;
use SplFileObject;

class WaveReader extends DataFileReader
{
    protected function validateFile(): void
    {
        // pass
    }
}
