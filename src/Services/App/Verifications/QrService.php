<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Verifications;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Verifications\QrContract;

final class QrService implements QrContract
{
    /**
     * @api
     */
    public QrRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new QrRawService($client);
    }
}
