<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Users;

use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Users\AccountData\AccountDataRetrieveParams;
use BeeperDesktop\Matrix\Users\AccountData\AccountDataUpdateParams;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface AccountDataRawContract
{
    /**
     * @api
     *
     * @param string $type The event type of the account data to get. Custom types should be
     * namespaced to avoid clashes.
     * @param array<string,mixed>|AccountDataRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $type,
        array|AccountDataRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $type Path param: The event type of the account data to set. Custom types should be
     * namespaced to avoid clashes.
     * @param array<string,mixed>|AccountDataUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $type,
        array|AccountDataUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
