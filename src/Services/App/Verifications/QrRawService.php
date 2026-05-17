<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Verifications;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Verifications\QrRawContract;

final class QrRawService implements QrRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
