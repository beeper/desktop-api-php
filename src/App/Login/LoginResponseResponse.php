<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember1;
use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type UnionMember0Shape from \BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \BeeperDesktop\App\Login\LoginResponseResponse\UnionMember1
 *
 * @phpstan-type LoginResponseResponseVariants = UnionMember0|UnionMember1
 * @phpstan-type LoginResponseResponseShape = LoginResponseResponseVariants|UnionMember0Shape|UnionMember1Shape
 */
final class LoginResponseResponse implements ConverterSource
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
