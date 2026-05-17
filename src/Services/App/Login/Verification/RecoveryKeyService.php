<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login\Verification;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Login\Verification\RecoveryKeyContract;
use BeeperDesktop\Services\App\Login\Verification\RecoveryKey\ResetService;

final class RecoveryKeyService implements RecoveryKeyContract
{
    /**
     * @api
     */
    public RecoveryKeyRawService $raw;

    /**
     * @api
     */
    public ResetService $reset;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RecoveryKeyRawService($client);
        $this->reset = new ResetService($client);
    }
}
