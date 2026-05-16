<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\MatrixRawContract;

/**
 * Matrix-compatible APIs for accounts, rooms, and connected network bridges.
 */
final class MatrixRawService implements MatrixRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
