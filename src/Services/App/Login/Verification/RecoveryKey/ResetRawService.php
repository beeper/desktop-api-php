<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login\Verification\RecoveryKey;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Login\Verification\RecoveryKey\ResetRawContract;

final class ResetRawService implements ResetRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
