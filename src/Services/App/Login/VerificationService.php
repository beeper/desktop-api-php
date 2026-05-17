<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Login\VerificationContract;
use BeeperDesktop\Services\App\Login\Verification\RecoveryKeyService;

final class VerificationService implements VerificationContract
{
    /**
     * @api
     */
    public VerificationRawService $raw;

    /**
     * @api
     */
    public RecoveryKeyService $recoveryKey;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VerificationRawService($client);
        $this->recoveryKey = new RecoveryKeyService($client);
    }
}
