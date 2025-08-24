<?php

declare(strict_types=1);

namespace BeeperDesktop\Shared\Attachment;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Attachment type.
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const UNKNOWN = 'unknown';

    public const IMG = 'img';

    public const VIDEO = 'video';

    public const AUDIO = 'audio';
}
