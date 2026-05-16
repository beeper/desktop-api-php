<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateDmParams;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Avatar;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Disappear;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Name;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Topic;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomNewDmResponse;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomNewGroupResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\RoomsRawContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type AvatarShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Avatar
 * @phpstan-import-type DisappearShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Disappear
 * @phpstan-import-type NameShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Name
 * @phpstan-import-type TopicShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Topic
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RoomsRawService implements RoomsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a direct chat with a user on the remote network.
     *
     * @param string $identifier path param: The identifier to resolve or start a chat with
     * @param array{bridgeID: string, loginID?: string}|RoomCreateDmParams $params
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
    ): BaseResponse {
        [$parsed, $options] = RoomCreateDmParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/create_dm/%2$s',
                $bridgeID,
                $identifier,
            ],
            query: Util::array_transform_keys($parsed, ['loginID' => 'login_id']),
            options: $options,
            convert: RoomNewDmResponse::class,
        );
    }

    /**
     * @api
     *
     * Create a group chat on the remote network.
     *
     * @param string $groupType path param: Group type to create
     * @param array{
     *   bridgeID: string,
     *   loginID?: string,
     *   avatar?: Avatar|AvatarShape,
     *   disappear?: Disappear|DisappearShape,
     *   name?: Name|NameShape,
     *   parent?: mixed,
     *   participants?: list<string>,
     *   roomID?: string,
     *   topic?: Topic|TopicShape,
     *   type?: string,
     *   username?: string,
     * }|RoomCreateGroupParams $params
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
    ): BaseResponse {
        [$parsed, $options] = RoomCreateGroupParams::parseRequest(
            $params,
            $requestOptions,
        );
        $bridgeID = $parsed['bridgeID'];
        unset($parsed['bridgeID']);
        $query_params = array_flip(['loginID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/create_group/%2$s',
                $bridgeID,
                $groupType,
            ],
            query: Util::array_transform_keys(
                array_intersect_key($parsed, $query_params),
                ['loginID' => 'login_id']
            ),
            body: (object) array_diff_key(
                array_diff_key($parsed, $query_params),
                array_flip(['bridgeID'])
            ),
            options: $options,
            convert: RoomNewGroupResponse::class,
        );
    }
}
