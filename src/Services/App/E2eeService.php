<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\E2eeContract;
use BeeperDesktop\Services\App\E2ee\RecoveryCodeService;
use BeeperDesktop\Services\App\E2ee\VerificationService;

/**
 * Manage encrypted messaging setup.
 */
final class E2eeService implements E2eeContract
{
    /**
     * @api
     */
    public E2eeRawService $raw;

    /**
     * @api
     */
    public RecoveryCodeService $recoveryCode;

    /**
     * @api
     */
    public VerificationService $verification;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new E2eeRawService($client);
        $this->recoveryCode = new RecoveryCodeService($client);
        $this->verification = new VerificationService($client);
    }
}
