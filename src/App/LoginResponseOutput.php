<?php

declare(strict_types=1);

namespace BeeperDesktop\App;

use BeeperDesktop\App\LoginResponseOutput\UnionMember0;
use BeeperDesktop\App\LoginResponseOutput\UnionMember1;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type UnionMember0Shape from \BeeperDesktop\App\LoginResponseOutput\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \BeeperDesktop\App\LoginResponseOutput\UnionMember1
 *
 * @phpstan-type LoginResponseOutputVariants = UnionMember0|UnionMember1
 * @phpstan-type LoginResponseOutputShape = LoginResponseOutputVariants|UnionMember0Shape|UnionMember1Shape
 */
final class LoginResponseOutput implements ConverterSource
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
