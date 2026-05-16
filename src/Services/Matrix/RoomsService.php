<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\InitialState;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Invite3pid;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Preset;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Visibility;
use BeeperDesktop\Matrix\Rooms\RoomJoinParams\ThirdPartySigned;
use BeeperDesktop\Matrix\Rooms\RoomJoinResponse;
use BeeperDesktop\Matrix\Rooms\RoomNewResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\RoomsContract;
use BeeperDesktop\Services\Matrix\Rooms\AccountDataService;
use BeeperDesktop\Services\Matrix\Rooms\EventsService;
use BeeperDesktop\Services\Matrix\Rooms\StateService;

/**
 * @phpstan-import-type InitialStateShape from \BeeperDesktop\Matrix\Rooms\RoomCreateParams\InitialState
 * @phpstan-import-type Invite3pidShape from \BeeperDesktop\Matrix\Rooms\RoomCreateParams\Invite3pid
 * @phpstan-import-type ThirdPartySignedShape from \BeeperDesktop\Matrix\Rooms\RoomJoinParams\ThirdPartySigned
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RoomsService implements RoomsContract
{
    /**
     * @api
     */
    public RoomsRawService $raw;

    /**
     * @api
     */
    public AccountDataService $accountData;

    /**
     * @api
     */
    public StateService $state;

    /**
     * @api
     */
    public EventsService $events;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RoomsRawService($client);
        $this->accountData = new AccountDataService($client);
        $this->state = new StateService($client);
        $this->events = new EventsService($client);
    }

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
     * @param mixed $creationContent Extra keys, such as `m.federate`, to be added to the content
     * of the [`m.room.create`](https://spec.matrix.org/v1.18/client-server-api/#mroomcreate) event.
     *
     * The server will overwrite the following
     * keys: `creator`, `room_version`. Future versions of the specification
     * may allow the server to overwrite other keys.
     *
     * When using the `trusted_private_chat` preset, the server SHOULD combine
     * `additional_creators` specified here and the `invite` array into the
     * eventual `m.room.create` event's `additional_creators`, deduplicating
     * between the two parameters.
     * @param list<InitialState|InitialStateShape> $initialState A list of state events to set in the new room. This allows
     * the user to override the default state events set in the new
     * room. The expected format of the state events are an object
     * with type, state_key and content keys set.
     *
     * Takes precedence over events set by `preset`, but gets
     * overridden by `name` and `topic` keys.
     * @param list<string> $invite A list of user IDs to invite to the room. This will tell the
     * server to invite everyone in the list to the newly created room.
     * @param list<Invite3pid|Invite3pidShape> $invite3pid a list of objects representing third-party IDs to invite into
     * the room
     * @param bool $isDirect This flag makes the server set the `is_direct` flag on the
     * `m.room.member` events sent to the users in `invite` and
     * `invite_3pid`. See [Direct Messaging](https://spec.matrix.org/v1.18/client-server-api/#direct-messaging) for more information.
     * @param string $name If this is included, an [`m.room.name`](https://spec.matrix.org/v1.18/client-server-api/#mroomname) event
     * will be sent into the room to indicate the name for the room.
     * This overwrites any [`m.room.name`](https://spec.matrix.org/v1.18/client-server-api/#mroomname)
     * event in `initial_state`.
     * @param mixed $powerLevelContentOverride The power level content to override in the default power level
     * event. This object is applied on top of the generated
     * [`m.room.power_levels`](https://spec.matrix.org/v1.18/client-server-api/#mroompower_levels)
     * event content prior to it being sent to the room. Defaults to
     * overriding nothing.
     * @param Preset|value-of<Preset> $preset Convenience parameter for setting various default state events
     * based on a preset.
     *
     * If unspecified, the server should use the `visibility` to determine
     * which preset to use. A visibility of `public` equates to a preset of
     * `public_chat` and `private` visibility equates to a preset of
     * `private_chat`.
     * @param string $roomAliasName The desired room alias **local part**. If this is included, a
     * room alias will be created and mapped to the newly created
     * room. The alias will belong on the *same* homeserver which
     * created the room. For example, if this was set to "foo" and
     * sent to the homeserver "example.com" the complete room alias
     * would be `#foo:example.com`.
     *
     * The complete room alias will become the canonical alias for
     * the room and an `m.room.canonical_alias` event will be sent
     * into the room.
     * @param string $roomVersion The room version to set for the room. If not provided, the homeserver is
     * to use its configured default. If provided, the homeserver will return a
     * 400 error with the errcode `M_UNSUPPORTED_ROOM_VERSION` if it does not
     * support the room version.
     * @param string $topic If this is included, an [`m.room.topic`](https://spec.matrix.org/v1.18/client-server-api/#mroomtopic)
     * event with a `text/plain` mimetype will be sent into the room
     * to indicate the topic for the room. This overwrites any
     * [`m.room.topic`](https://spec.matrix.org/v1.18/client-server-api/#mroomtopic) event in `initial_state`.
     * @param Visibility|value-of<Visibility> $visibility The room's visibility in the server's
     * [published room directory](https://spec.matrix.org/v1.18/client-server-api#published-room-directory).
     * Defaults to `private`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        mixed $creationContent = null,
        ?array $initialState = null,
        ?array $invite = null,
        ?array $invite3pid = null,
        ?bool $isDirect = null,
        ?string $name = null,
        mixed $powerLevelContentOverride = null,
        Preset|string|null $preset = null,
        ?string $roomAliasName = null,
        ?string $roomVersion = null,
        ?string $topic = null,
        Visibility|string|null $visibility = null,
        RequestOptions|array|null $requestOptions = null,
    ): RoomNewResponse {
        $params = Util::removeNulls(
            [
                'creationContent' => $creationContent,
                'initialState' => $initialState,
                'invite' => $invite,
                'invite3pid' => $invite3pid,
                'isDirect' => $isDirect,
                'name' => $name,
                'powerLevelContentOverride' => $powerLevelContentOverride,
                'preset' => $preset,
                'roomAliasName' => $roomAliasName,
                'roomVersion' => $roomVersion,
                'topic' => $topic,
                'visibility' => $visibility,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param list<string> $via Query param: The servers to attempt to join the room through. One of the servers
     * must be participating in the room.
     * @param string $reason body param: Optional reason to be included as the `reason` on the subsequent
     * membership event
     * @param ThirdPartySigned|ThirdPartySignedShape $thirdPartySigned Body param: A signature of an `m.third_party_invite` token to prove that this user
     * owns a third-party identity which has been invited to the room.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function join(
        string $roomIDOrAlias,
        ?array $via = null,
        ?string $reason = null,
        ThirdPartySigned|array|null $thirdPartySigned = null,
        RequestOptions|array|null $requestOptions = null,
    ): RoomJoinResponse {
        $params = Util::removeNulls(
            [
                'via' => $via,
                'reason' => $reason,
                'thirdPartySigned' => $thirdPartySigned,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->join($roomIDOrAlias, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string $reason optional reason to be included as the `reason` on the subsequent
     * membership event
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function leave(
        string $roomID,
        ?string $reason = null,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['reason' => $reason]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->leave($roomID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
