<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\Matrix\BridgesRawContract;

/**
 * Matrix-compatible APIs for connected network bridges.
 */
final class BridgesRawService implements BridgesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
