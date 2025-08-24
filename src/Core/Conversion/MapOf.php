<?php

declare(strict_types=1);

namespace BeeperDesktop\Core\Conversion;

use BeeperDesktop\Core\Conversion\Concerns\ArrayOf;
use BeeperDesktop\Core\Conversion\Contracts\Converter;

/**
 * @internal
 */
final class MapOf implements Converter
{
    use ArrayOf;
}
