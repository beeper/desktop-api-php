<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\LoginContract;
use BeeperDesktop\Services\App\Login\VerificationService;

/**
 * Complete first-party Beeper app login.
 */
final class LoginService implements LoginContract
{
    /**
     * @api
     */
    public LoginRawService $raw;

    /**
     * @api
     */
    public VerificationService $verification;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LoginRawService($client);
        $this->verification = new VerificationService($client);
    }
}
