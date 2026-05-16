<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Rooms;

use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\State\StateListResponseItem;
use BeeperDesktop\Matrix\Rooms\State\StateRetrieveParams;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface StateRawContract
{
    /**
     * @api
     *
     * @param string $stateKey Path param: The key of the state to look up. Defaults to an empty string. When
     * an empty string, the trailing slash on this endpoint is optional.
     * @param array<string,mixed>|StateRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function retrieve(
        string $stateKey,
        array|StateRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $roomID the room to look up the state for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<StateListResponseItem>>
     *
     * @throws APIException
     */
    public function list(
        string $roomID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;
}
