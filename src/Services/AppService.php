<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\AppContract;
use BeeperDesktop\Services\App\LoginService;
use BeeperDesktop\Services\App\VerificationsService;

/**
 * Manage Beeper app login and encrypted messaging setup.
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
    public LoginService $login;

    /**
     * @api
     */
    public VerificationsService $verifications;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AppRawService($client);
        $this->login = new LoginService($client);
        $this->verifications = new VerificationsService($client);
    }
}
