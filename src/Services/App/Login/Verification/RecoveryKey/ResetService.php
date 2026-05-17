<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login\Verification\RecoveryKey;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Login\Verification\RecoveryKey\ResetContract;

final class ResetService implements ResetContract
{
    /**
     * @api
     */
    public ResetRawService $raw;

    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ResetRawService($client);
    }
}
