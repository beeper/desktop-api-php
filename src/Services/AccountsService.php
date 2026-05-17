<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Accounts\Account;
use BeeperDesktop\Accounts\AccountGetResponse;
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
     * Get one chat account connected to this Beeper Client API server.
     *
     * @param string $accountID account ID this resource belongs to
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $accountID,
        RequestOptions|array|null $requestOptions = null
    ): AccountGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($accountID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List chat accounts connected to this Beeper Client API server, including bridge, network, user identity, and connection status.
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
