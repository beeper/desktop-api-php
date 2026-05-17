<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Verifications;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Verifications\SASRawContract;

final class SASRawService implements SASRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
