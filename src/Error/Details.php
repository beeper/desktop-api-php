<?php

declare(strict_types=1);

namespace BeeperDesktop\Error;

use BeeperDesktop\Core\Concerns\SdkUnion;
use BeeperDesktop\Core\Conversion\Contracts\Converter;
use BeeperDesktop\Core\Conversion\Contracts\ConverterSource;
use BeeperDesktop\Core\Conversion\MapOf;
use BeeperDesktop\Error\Details\Issues;

/**
 * Additional error details for debugging.
 *
 * @phpstan-import-type IssuesShape from \BeeperDesktop\Error\Details\Issues
 *
 * @phpstan-type DetailsVariants = mixed|null|Issues|array<string,mixed>
 * @phpstan-type DetailsShape = DetailsVariants|IssuesShape
 */
final class Details implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [Issues::class, new MapOf('mixed', nullable: true), 'mixed'];
    }
}
