<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\InitialState;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Invite3pid;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Preset;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Visibility;
use BeeperDesktop\Matrix\Rooms\RoomJoinParams\ThirdPartySigned;
use BeeperDesktop\Matrix\Rooms\RoomJoinResponse;
use BeeperDesktop\Matrix\Rooms\RoomNewResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type InitialStateShape from \BeeperDesktop\Matrix\Rooms\RoomCreateParams\InitialState
 * @phpstan-import-type Invite3pidShape from \BeeperDesktop\Matrix\Rooms\RoomCreateParams\Invite3pid
 * @phpstan-import-type ThirdPartySignedShape from \BeeperDesktop\Matrix\Rooms\RoomJoinParams\ThirdPartySigned
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface RoomsContract
{
    /**
     * @api
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
    ): RoomNewResponse;

    /**
     * @api
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
    ): RoomJoinResponse;

    /**
     * @api
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
    ): mixed;
}
