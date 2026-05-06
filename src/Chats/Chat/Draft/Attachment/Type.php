<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Draft\Attachment;

/**
 * Draft attachment type. GIF and recorded audio are mutually exclusive types.
 */
enum Type: string
{
    case FILE = 'file';

    case GIF = 'gif';

    case RECORDED_AUDIO = 'recorded_audio';
}
