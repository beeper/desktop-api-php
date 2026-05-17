<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\Bridges\ConnectionsContract;

final class ConnectionsService implements ConnectionsContract
{
    /**
     * @api
     */
    public ConnectionsRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ConnectionsRawService($client);
    }
}
