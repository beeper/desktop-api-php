<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitUserInputResponse\UnionMember1\UserInput\Attachment;

/**
 * The type of media attachment, using the same media type identifiers as Matrix attachments. Only some are supported.
 */
enum Type: string
{
    case M_IMAGE = 'm.image';

    case M_AUDIO = 'm.audio';
}
