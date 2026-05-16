<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Bridges;

use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateDmParams;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomNewDmResponse;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomNewGroupResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RoomsRawContract
{
    /**
     * @api
     *
     * @param string $identifier path param: The identifier to resolve or start a chat with
     * @param array<string,mixed>|RoomCreateDmParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoomNewDmResponse>
     *
     * @throws APIException
     */
    public function createDm(
        string $identifier,
        array|RoomCreateDmParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $groupType path param: Group type to create
     * @param array<string,mixed>|RoomCreateGroupParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoomNewGroupResponse>
     *
     * @throws APIException
     */
    public function createGroup(
        string $groupType,
        array|RoomCreateGroupParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
