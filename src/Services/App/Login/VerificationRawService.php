<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Login;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\Login\VerificationRawContract;

final class VerificationRawService implements VerificationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
