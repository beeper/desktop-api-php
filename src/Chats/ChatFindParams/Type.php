<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatFindParams;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Specify the type of chats to retrieve: use "single" for direct messages, "group" for group chats, "channel" for channels, or "any" to get all types.
 */
final class Type implements ConverterSource
{
    use SdkEnum;

    public const SINGLE = 'single';

    public const GROUP = 'group';

    public const CHANNEL = 'channel';

    public const ANY = 'any';
}
