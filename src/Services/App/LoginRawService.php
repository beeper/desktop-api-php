<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\LoginRawContract;

/**
 * Complete first-party Beeper app login.
 */
final class LoginRawService implements LoginRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
