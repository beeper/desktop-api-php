<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\Bridges\ConnectionsRawContract;

final class ConnectionsRawService implements ConnectionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
