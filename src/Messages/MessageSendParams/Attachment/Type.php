<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\MessageSendParams\Attachment;

/**
 * Special attachment type (gif, voiceNote, sticker). If omitted, auto-detected from mimeType.
 */
enum Type: string
{
    case GIF = 'gif';

    case VOICE_NOTE = 'voiceNote';

    case STICKER = 'sticker';
}
