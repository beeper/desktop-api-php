<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\InitialState;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Invite3pid;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Preset;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Visibility;
use BeeperDesktop\Matrix\Rooms\RoomJoinParams;
use BeeperDesktop\Matrix\Rooms\RoomJoinParams\ThirdPartySigned;
use BeeperDesktop\Matrix\Rooms\RoomJoinResponse;
use BeeperDesktop\Matrix\Rooms\RoomLeaveParams;
use BeeperDesktop\Matrix\Rooms\RoomNewResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\RoomsRawContract;

/**
 * @phpstan-import-type InitialStateShape from \BeeperDesktop\Matrix\Rooms\RoomCreateParams\InitialState
 * @phpstan-import-type Invite3pidShape from \BeeperDesktop\Matrix\Rooms\RoomCreateParams\Invite3pid
 * @phpstan-import-type ThirdPartySignedShape from \BeeperDesktop\Matrix\Rooms\RoomJoinParams\ThirdPartySigned
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
     * Create a new room with various configuration options.
     *
     * The server MUST apply the normal state resolution rules when creating
     * the new room, including checking power levels for each event. It MUST
     * apply the events implied by the request in the following order:
     *
     * 1. The `m.room.create` event itself. Must be the first event in the
     *    room.
     *
     * 2. An `m.room.member` event for the creator to join the room. This is
     *    needed so the remaining events can be sent.
     *
     * 3. A default `m.room.power_levels` event. Overridden by the
     *    `power_level_content_override` parameter.
     *
     *    In [room versions](https://spec.matrix.org/v1.18/rooms) 1 through 11, the room creator (and not
     *    other members) will be given permission to send state events.
     *
     *    In room versions 12 and later, the room creator is given infinite
     *    power level and cannot be specified in the `users` field of
     *    `m.room.power_levels`, so is not listed explicitly.
     *
     *    **Note**: For `trusted_private_chat`, the users specified in the
     *    `invite` parameter SHOULD also be appended to `additional_creators`
     *    by the server, per the `creation_content` parameter.
     *
     *    If the room's version is 12 or higher, the power level for sending
     *    `m.room.tombstone` events MUST explicitly be higher than `state_default`.
     *    For example, set to 150 instead of 100.
     *
     * 4. An `m.room.canonical_alias` event if `room_alias_name` is given.
     *
     * 5. Events set by the `preset`. Currently these are the `m.room.join_rules`,
     *    `m.room.history_visibility`, and `m.room.guest_access` state events.
     *
     * 6. Events listed in `initial_state`, in the order that they are
     *    listed.
     *
     * 7. Events implied by `name` and `topic` (`m.room.name` and `m.room.topic`
     *    state events).
     *
     * 8. Invite events implied by `invite` and `invite_3pid` (`m.room.member` with
     *    `membership: invite` and `m.room.third_party_invite`).
     *
     * The available presets do the following with respect to room state:
     *
     * | Preset                 | `join_rules` | `history_visibility` | `guest_access` | Other |
     * |------------------------|--------------|----------------------|----------------|-------|
     * | `private_chat`         | `invite`     | `shared`             | `can_join`     |       |
     * | `trusted_private_chat` | `invite`     | `shared`             | `can_join`     | All invitees are given the same power level as the room creator. |
     * | `public_chat`          | `public`     | `shared`             | `forbidden`    |       |
     *
     * The server will create a `m.room.create` event in the room with the
     * requesting user as the creator, alongside other keys provided in the
     * `creation_content` or implied by behaviour of `creation_content`.
     *
     * @param array{
     *   creationContent?: mixed,
     *   initialState?: list<InitialState|InitialStateShape>,
     *   invite?: list<string>,
     *   invite3pid?: list<Invite3pid|Invite3pidShape>,
     *   isDirect?: bool,
     *   name?: string,
     *   powerLevelContentOverride?: mixed,
     *   preset?: Preset|value-of<Preset>,
     *   roomAliasName?: string,
     *   roomVersion?: string,
     *   topic?: string,
     *   visibility?: Visibility|value-of<Visibility>,
     * }|RoomCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<RoomNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|RoomCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RoomCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: '_matrix/client/v3/createRoom',
            body: (object) $parsed,
            options: $options,
            convert: RoomNewResponse::class,
        );
    }

    /**
     * @api
     *
     * *Note that this API takes either a room ID or alias, unlike* `/rooms/{roomId}/join`.
     *
     * This API starts a user's participation in a particular room, if that user
     * is allowed to participate in that room. After this call, the client is
     * allowed to see all current state events in the room, and all subsequent
     * events associated with the room until the user leaves the room.
     *
     * After a user has joined a room, the room will appear as an entry in the
     * response of the [`/initialSync`](https://spec.matrix.org/v1.18/client-server-api/#get_matrixclientv3initialsync)
     * and [`/sync`](https://spec.matrix.org/v1.18/client-server-api/#get_matrixclientv3sync) APIs.
     *
     * @param string $roomIDOrAlias path param: The room identifier or alias to join
     * @param array{
     *   via?: list<string>,
     *   reason?: string,
     *   thirdPartySigned?: ThirdPartySigned|ThirdPartySignedShape,
     * }|RoomJoinParams $params
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
    ): BaseResponse {
        [$parsed, $options] = RoomJoinParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['via']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['_matrix/client/v3/join/%1$s', $roomIDOrAlias],
            query: array_intersect_key($parsed, $query_params),
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: RoomJoinResponse::class,
        );
    }

    /**
     * @api
     *
     * This API stops a user participating in a particular room.
     *
     * If the user was already in the room, they will no longer be able to see
     * new events in the room. If the room requires an invite to join, they
     * will need to be re-invited before they can re-join.
     *
     * If the user was invited to the room, but had not joined, this call
     * serves to reject the invite.
     *
     * Servers MAY additionally forget the room when this endpoint is called –
     * just as if the user had also invoked [`/forget`](https://spec.matrix.org/v1.18/client-server-api/#post_matrixclientv3roomsroomidforget).
     * Servers that do this, MUST inform clients about this behavior using the
     * [`m.forget_forced_upon_leave`](https://spec.matrix.org/v1.18/client-server-api/#mforget_forced_upon_leave-capability)
     * capability.
     *
     * If the server doesn't automatically forget the room, the user will still be
     * allowed to retrieve history from the room which they were previously allowed
     * to see.
     *
     * @param string $roomID the room identifier to leave
     * @param array{reason?: string}|RoomLeaveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = RoomLeaveParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['_matrix/client/v3/rooms/%1$s/leave', $roomID],
            body: (object) $parsed,
            options: $options,
            convert: 'mixed',
        );
    }
}
