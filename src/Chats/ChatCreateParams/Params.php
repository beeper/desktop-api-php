<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams;

use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember0;
use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember1;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type UnionMember0Shape from \BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember1
 *
 * @phpstan-type ParamsVariants = UnionMember0|UnionMember1
 * @phpstan-type ParamsShape = ParamsVariants|UnionMember0Shape|UnionMember1Shape
 */
final class Params implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UnionMember0::class, UnionMember1::class];
    }
}
