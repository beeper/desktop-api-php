<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\GetChatResponse;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Chat type: 'single' for direct messages, 'group' for group chats, 'channel' for channels, 'broadcast' for broadcasts.
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const SINGLE = 'single';

    public const GROUP = 'group';

    public const CHANNEL = 'channel';

    public const BROADCAST = 'broadcast';
}
