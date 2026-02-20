<?php

declare(strict_types=1);

namespace BeeperDesktop\Attachment;

/**
 * Attachment type.
 */
enum Type: string
{
    case UNKNOWN = 'unknown';

    case IMG = 'img';

    case VIDEO = 'video';

    case AUDIO = 'audio';
}
