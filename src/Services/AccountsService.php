<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Accounts\Account;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\AccountsContract;
use BeeperDesktop\Services\Accounts\ContactsService;

/**
 * Manage connected chat accounts.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class AccountsService implements AccountsContract
{
    /**
     * @api
     */
    public AccountsRawService $raw;

    /**
     * @api
     */
    public ContactsService $contacts;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AccountsRawService($client);
        $this->contacts = new ContactsService($client);
    }

    /**
     * @api
     *
     * List Chat Accounts connected to this Beeper Desktop instance, including bridge metadata and network identity.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<Account>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }
}
