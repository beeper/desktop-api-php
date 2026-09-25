<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\AppRawContract;

/**
 * Manage Beeper account setup and encrypted messaging setup.
 */
final class AppRawService implements AppRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
