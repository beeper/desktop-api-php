<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\MessageSendParams\Attachment;

/**
 * Attachment type hint (image, video, audio, file, gif, voice-note, sticker). If omitted, auto-detected from mimeType.
 */
enum Type: string
{
    case IMAGE = 'image';

    case VIDEO = 'video';

    case AUDIO = 'audio';

    case FILE = 'file';

    case GIF = 'gif';

    case VOICE_NOTE = 'voice-note';

    case STICKER = 'sticker';
}
