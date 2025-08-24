<?php

declare(strict_types=1);

namespace BeeperDesktop\Core\Conversion\Contracts;

use BeeperDesktop\Core\Conversion\CoerceState;
use BeeperDesktop\Core\Conversion\DumpState;

/**
 * @internal
 */
interface Converter
{
    /**
     * @internal
     */
    public function coerce(mixed $value, CoerceState $state): mixed;

    /**
     * @internal
     */
    public function dump(mixed $value, DumpState $state): mixed;
}
