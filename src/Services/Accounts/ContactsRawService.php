<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Accounts;

use BeeperDesktop\Accounts\Contacts\ContactListParams;
use BeeperDesktop\Accounts\Contacts\ContactListParams\Direction;
use BeeperDesktop\Accounts\Contacts\ContactSearchParams;
use BeeperDesktop\Accounts\Contacts\ContactSearchResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Accounts\ContactsRawContract;
use BeeperDesktop\User;

/**
 * Manage contacts on a specific account.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class ContactsRawService implements ContactsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List merged contacts for a specific account with cursor-based pagination.
     *
     * @param string $accountID account ID this resource belongs to
     * @param array{
     *   cursor?: string,
     *   direction?: Direction|value-of<Direction>,
     *   limit?: int,
     *   query?: string,
     * }|ContactListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CursorSearch<User>>
     *
     * @throws APIException
     */
    public function list(
        string $accountID,
        array|ContactListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ContactListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/accounts/%1$s/contacts/list', $accountID],
            query: $parsed,
            options: $options,
            convert: User::class,
            page: CursorSearch::class,
        );
    }

    /**
     * @api
     *
     * Search contacts on a specific account using merged account contacts, network search, and exact identifier lookup.
     *
     * @param string $accountID account ID this resource belongs to
     * @param array{query: string}|ContactSearchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ContactSearchResponse>
     *
     * @throws APIException
     */
    public function search(
        string $accountID,
        array|ContactSearchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ContactSearchParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['v1/accounts/%1$s/contacts', $accountID],
            query: $parsed,
            options: $options,
            convert: ContactSearchResponse::class,
        );
    }
}
