<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix;

use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams;
use BeeperDesktop\Matrix\Rooms\RoomJoinParams;
use BeeperDesktop\Matrix\Rooms\RoomJoinResponse;
use BeeperDesktop\Matrix\Rooms\RoomLeaveParams;
use BeeperDesktop\Matrix\Rooms\RoomNewResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RoomsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|RoomCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoomNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|RoomCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $roomIDOrAlias path param: The room identifier or alias to join
     * @param array<string,mixed>|RoomJoinParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoomJoinResponse>
     *
     * @throws APIException
     */
    public function join(
        string $roomIDOrAlias,
        array|RoomJoinParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $roomID the room identifier to leave
     * @param array<string,mixed>|RoomLeaveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function leave(
        string $roomID,
        array|RoomLeaveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
