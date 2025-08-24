<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatFindParams;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by inbox type: "primary" (non-archived, non-low-priority), "low-priority", or "archive". If not specified, shows all chats.
 */
final class Inbox implements ConverterSource
{
    use SdkEnum;

    public const PRIMARY = 'primary';

    public const LOW_PRIORITY = 'low-priority';

    public const ARCHIVE = 'archive';
}
