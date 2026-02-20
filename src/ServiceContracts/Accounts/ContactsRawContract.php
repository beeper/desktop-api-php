<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Accounts;

use BeeperDesktop\Accounts\Contacts\ContactListParams;
use BeeperDesktop\Accounts\Contacts\ContactSearchParams;
use BeeperDesktop\Accounts\Contacts\ContactSearchResponse;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\User;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ContactsRawContract
{
    /**
     * @api
     *
     * @param string $accountID account ID this resource belongs to
     * @param array<string,mixed>|ContactListParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $accountID account ID this resource belongs to
     * @param array<string,mixed>|ContactSearchParams $params
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
    ): BaseResponse;
}
