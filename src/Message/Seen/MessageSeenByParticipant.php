<?php

declare(strict_types=1);

namespace BeeperDesktop\Message\Seen;

use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * ISO 8601 timestamp.
 *
 * @phpstan-type MessageSeenByParticipantVariants = bool|\DateTimeInterface
 * @phpstan-type MessageSeenByParticipantShape = MessageSeenByParticipantVariants
 */
final class MessageSeenByParticipant implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return ['bool', '\DateTimeInterface'];
    }
}
