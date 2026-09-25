<?php

declare(strict_types=1);

namespace BeeperDesktop\Message;

use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;
use BeeperDesktop\Core\Conversion\MapOf;
use BeeperDesktop\Message\Seen\MessageSeenByParticipant;

/**
 * Read receipt state for this message, when available.
 *
 * @phpstan-import-type MessageSeenByParticipantShape from \BeeperDesktop\Message\Seen\MessageSeenByParticipant
 *
 * @phpstan-type SeenVariants = bool|\DateTimeInterface|array<string,bool|\DateTimeInterface>
 * @phpstan-type SeenShape = SeenVariants|array<string,MessageSeenByParticipantShape>
 */
final class Seen implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            'bool', '\DateTimeInterface', new MapOf(MessageSeenByParticipant::class),
        ];
    }
}
