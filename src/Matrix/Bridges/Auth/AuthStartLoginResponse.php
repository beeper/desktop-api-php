<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth;

use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember0;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember1;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember2;
use BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember3;

/**
 * A step in a login process.
 *
 * @phpstan-import-type UnionMember0Shape from \BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember0
 * @phpstan-import-type UnionMember1Shape from \BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember1
 * @phpstan-import-type UnionMember2Shape from \BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember2
 * @phpstan-import-type UnionMember3Shape from \BeeperDesktop\Matrix\Bridges\Auth\AuthStartLoginResponse\UnionMember3
 *
 * @phpstan-type AuthStartLoginResponseVariants = UnionMember0|UnionMember1|UnionMember2|UnionMember3
 * @phpstan-type AuthStartLoginResponseShape = AuthStartLoginResponseVariants|UnionMember0Shape|UnionMember1Shape|UnionMember2Shape|UnionMember3Shape
 */
final class AuthStartLoginResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            UnionMember0::class,
            UnionMember1::class,
            UnionMember2::class,
            UnionMember3::class,
        ];
    }
}
