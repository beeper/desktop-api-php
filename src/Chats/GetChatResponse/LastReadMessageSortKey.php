<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\GetChatResponse;

use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * Last read message sortKey (hsOrder). Used to compute 'isUnread'.
 */
final class LastReadMessageSortKey implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return ['int', 'string'];
    }
}
