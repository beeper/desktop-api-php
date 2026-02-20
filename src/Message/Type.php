<?php

declare(strict_types=1);

namespace BeeperDesktop\Message;

/**
 * Message content type. Useful for distinguishing reactions, media messages, and state events from regular text messages.
 */
enum Type: string
{
    case TEXT = 'TEXT';

    case NOTICE = 'NOTICE';

    case IMAGE = 'IMAGE';

    case VIDEO = 'VIDEO';

    case VOICE = 'VOICE';

    case AUDIO = 'AUDIO';

    case FILE = 'FILE';

    case STICKER = 'STICKER';

    case LOCATION = 'LOCATION';

    case REACTION = 'REACTION';
}
