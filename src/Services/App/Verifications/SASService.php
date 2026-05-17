<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Verifications;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Verifications\SASContract;

final class SASService implements SASContract
{
    /**
     * @api
     */
    public SASRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new SASRawService($client);
    }
}
