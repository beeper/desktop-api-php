<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login\Verification;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Login\Verification\RecoveryKeyRawContract;

final class RecoveryKeyRawService implements RecoveryKeyRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
