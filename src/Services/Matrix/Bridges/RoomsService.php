<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Avatar;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Disappear;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Name;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Topic;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomNewDmResponse;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomNewGroupResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\RoomsContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type AvatarShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Avatar
 * @phpstan-import-type DisappearShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Disappear
 * @phpstan-import-type NameShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Name
 * @phpstan-import-type TopicShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Topic
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RoomsService implements RoomsContract
{
    /**
     * @api
     */
    public RoomsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RoomsRawService($client);
    }

    /**
     * @api
     *
     * Create a direct chat with a user on the remote network.
     *
     * @param string $identifier path param: The identifier to resolve or start a chat with
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginID query param: An optional explicit login ID to do the action through
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createDm(
        string $identifier,
        string $bridgeID,
        ?string $loginID = null,
        RequestOptions|array|null $requestOptions = null,
    ): RoomNewDmResponse {
        $params = Util::removeNulls(
            ['bridgeID' => $bridgeID, 'loginID' => $loginID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createDm($identifier, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Create a group chat on the remote network.
     *
     * @param string $groupType path param: Group type to create
     * @param string $bridgeID path param: Bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param string $loginID query param: An optional explicit login ID to do the action through
     * @param Avatar|AvatarShape $avatar Body param: The `m.room.avatar` event content for the room.
     * @param Disappear|DisappearShape $disappear Body param: The `com.beeper.disappearing_timer` event content for the room.
     * @param Name|NameShape $name Body param: The `m.room.name` event content for the room.
     * @param mixed $parent Body param
     * @param list<string> $participants body param: The users to add to the group initially
     * @param string $roomID Body param: An existing Matrix room ID to bridge to.
     * The other parameters must be already in sync with the room state when using this parameter.
     * @param Topic|TopicShape $topic Body param: The `m.room.topic` event content for the room.
     * @param string $type body param: The type of group to create
     * @param string $username body param: The public username for the created group
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function createGroup(
        string $groupType,
        string $bridgeID,
        ?string $loginID = null,
        Avatar|array|null $avatar = null,
        Disappear|array|null $disappear = null,
        Name|array|null $name = null,
        mixed $parent = null,
        ?array $participants = null,
        ?string $roomID = null,
        Topic|array|null $topic = null,
        ?string $type = null,
        ?string $username = null,
        RequestOptions|array|null $requestOptions = null,
    ): RoomNewGroupResponse {
        $params = Util::removeNulls(
            [
                'bridgeID' => $bridgeID,
                'loginID' => $loginID,
                'avatar' => $avatar,
                'disappear' => $disappear,
                'name' => $name,
                'parent' => $parent,
                'participants' => $participants,
                'roomID' => $roomID,
                'topic' => $topic,
                'type' => $type,
                'username' => $username,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->createGroup($groupType, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
