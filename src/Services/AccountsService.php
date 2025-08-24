<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Accounts\AccountsResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Contracts\AccountsContract;
use BeeperDesktop\Core\Conversion;
use BeeperDesktop\RequestOptions;

/**
 * Manage and list connected messaging accounts.
 */
final class AccountsService implements AccountsContract
{
    public function __construct(private Client $client) {}

    /**
     * List connected Beeper accounts available on this device.
     * - When to use: select account context before account-scoped operations.
     * - Scope: only accounts currently Connected on this device are included.
     * Returns: connected accounts.
     */
    public function list(
        ?RequestOptions $requestOptions = null
    ): AccountsResponse {
        $resp = $this->client->request(
            method: 'get',
            path: 'v0/get-accounts',
            options: $requestOptions
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(AccountsResponse::class, value: $resp);
    }
}
