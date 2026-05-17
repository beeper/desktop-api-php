<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\App\VerificationsRawContract;

/**
 * Manage device verification transactions.
 */
final class VerificationsRawService implements VerificationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
