<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\AppRawContract;

/**
 * Manage Beeper app login and encrypted messaging setup.
 */
final class AppRawService implements AppRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
