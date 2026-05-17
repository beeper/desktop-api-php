<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Accounts;

use BeeperDesktop\Accounts\Contacts\ContactListParams\Direction;
use BeeperDesktop\Accounts\Contacts\ContactSearchResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\User;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ContactsContract
{
    /**
     * @api
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
    ): CursorSearch;

    /**
     * @api
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
    ): ContactSearchResponse;
}
