<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Accounts;

use BeeperDesktop\Accounts\Contacts\ContactListParams\Direction;
use BeeperDesktop\Accounts\Contacts\ContactSearchResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Accounts\ContactsContract;
use BeeperDesktop\User;

/**
 * Manage contacts on a specific account.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ContactsService implements ContactsContract
{
    /**
     * @api
     */
    public ContactsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ContactsRawService($client);
    }

    /**
     * @api
     *
     * List merged contacts for a specific account with cursor-based pagination.
     *
     * @param string $accountID account ID this resource belongs to
     * @param string $cursor Opaque pagination cursor; do not inspect. Use together with 'direction'.
     * @param Direction|value-of<Direction> $direction Pagination direction used with 'cursor': 'before' fetches older results, 'after' fetches newer results. Defaults to 'before' when only 'cursor' is provided.
     * @param int $limit maximum contacts to return per page
     * @param string $query optional search query for contact lookup
     * @param RequestOpts|null $requestOptions
     *
     * @return CursorSearch<User>
     *
     * @throws APIException
     */
    public function list(
        string $accountID,
        ?string $cursor = null,
        Direction|string|null $direction = null,
        int $limit = 50,
        ?string $query = null,
        RequestOptions|array|null $requestOptions = null,
    ): CursorSearch {
        $params = Util::removeNulls(
            [
                'cursor' => $cursor,
                'direction' => $direction,
                'limit' => $limit,
                'query' => $query,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($accountID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Search contacts on a specific account using merged account contacts, network search, and exact identifier lookup.
     *
     * @param string $accountID account ID this resource belongs to
     * @param string $query Text to search contacts by. Matching behavior depends on the network.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $accountID,
        string $query,
        RequestOptions|array|null $requestOptions = null,
    ): ContactSearchResponse {
        $params = Util::removeNulls(['query' => $query]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->search($accountID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
