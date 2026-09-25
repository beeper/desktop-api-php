<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\AppContract;
use BeeperDesktop\Services\App\SetupService;

/**
 * Manage Beeper account setup and encrypted messaging setup.
 */
final class AppService implements AppContract
{
    /**
     * @api
     */
    public AppRawService $raw;

    /**
     * @api
     */
    public SetupService $setup;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AppRawService($client);
        $this->setup = new SetupService($client);
    }
}
