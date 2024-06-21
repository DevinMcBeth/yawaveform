<?php

declare(strict_types=1);

namespace Yawaveform\File;

use SplFileObject;

interface ReaderInterface
{
    public function getFile(): SplFileObject;
}
