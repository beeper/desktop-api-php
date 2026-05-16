<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\E2eeRawContract;

/**
 * Manage encrypted messaging setup.
 */
final class E2eeRawService implements E2eeRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
