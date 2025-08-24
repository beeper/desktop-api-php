<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\SearchRequest;

use BeeperDesktop\Core\Concerns\SdkEnum;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Filter by chat type: 'group' for group chats, 'single' for 1:1 chats.
 */
final class ChatType implements ConverterSource
{
    use SdkEnum;

    public const GROUP = 'group';

    public const SINGLE = 'single';
}
