<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\InitialState;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Invite3pid;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Preset;
use BeeperDesktop\Matrix\Rooms\RoomCreateParams\Visibility;

/**
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
 * @see BeeperDesktop\Services\Matrix\RoomsService::create()
 *
 * @phpstan-import-type InitialStateShape from \BeeperDesktop\Matrix\Rooms\RoomCreateParams\InitialState
 * @phpstan-import-type Invite3pidShape from \BeeperDesktop\Matrix\Rooms\RoomCreateParams\Invite3pid
 *
 * @phpstan-type RoomCreateParamsShape = array{
 *   creationContent?: mixed,
 *   initialState?: list<InitialState|InitialStateShape>|null,
 *   invite?: list<string>|null,
 *   invite3pid?: list<Invite3pid|Invite3pidShape>|null,
 *   isDirect?: bool|null,
 *   name?: string|null,
 *   powerLevelContentOverride?: mixed,
 *   preset?: null|Preset|value-of<Preset>,
 *   roomAliasName?: string|null,
 *   roomVersion?: string|null,
 *   topic?: string|null,
 *   visibility?: null|Visibility|value-of<Visibility>,
 * }
 */
final class RoomCreateParams implements BaseModel
{
    /** @use SdkModel<RoomCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Extra keys, such as `m.federate`, to be added to the content
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
     */
    #[Optional('creation_content')]
    public mixed $creationContent;

    /**
     * A list of state events to set in the new room. This allows
     * the user to override the default state events set in the new
     * room. The expected format of the state events are an object
     * with type, state_key and content keys set.
     *
     * Takes precedence over events set by `preset`, but gets
     * overridden by `name` and `topic` keys.
     *
     * @var list<InitialState>|null $initialState
     */
    #[Optional('initial_state', list: InitialState::class)]
    public ?array $initialState;

    /**
     * A list of user IDs to invite to the room. This will tell the
     * server to invite everyone in the list to the newly created room.
     *
     * @var list<string>|null $invite
     */
    #[Optional(list: 'string')]
    public ?array $invite;

    /**
     * A list of objects representing third-party IDs to invite into
     * the room.
     *
     * @var list<Invite3pid>|null $invite3pid
     */
    #[Optional('invite_3pid', list: Invite3pid::class)]
    public ?array $invite3pid;

    /**
     * This flag makes the server set the `is_direct` flag on the
     * `m.room.member` events sent to the users in `invite` and
     * `invite_3pid`. See [Direct Messaging](https://spec.matrix.org/v1.18/client-server-api/#direct-messaging) for more information.
     */
    #[Optional('is_direct')]
    public ?bool $isDirect;

    /**
     * If this is included, an [`m.room.name`](https://spec.matrix.org/v1.18/client-server-api/#mroomname) event
     * will be sent into the room to indicate the name for the room.
     * This overwrites any [`m.room.name`](https://spec.matrix.org/v1.18/client-server-api/#mroomname)
     * event in `initial_state`.
     */
    #[Optional]
    public ?string $name;

    /**
     * The power level content to override in the default power level
     * event. This object is applied on top of the generated
     * [`m.room.power_levels`](https://spec.matrix.org/v1.18/client-server-api/#mroompower_levels)
     * event content prior to it being sent to the room. Defaults to
     * overriding nothing.
     */
    #[Optional('power_level_content_override')]
    public mixed $powerLevelContentOverride;

    /**
     * Convenience parameter for setting various default state events
     * based on a preset.
     *
     * If unspecified, the server should use the `visibility` to determine
     * which preset to use. A visibility of `public` equates to a preset of
     * `public_chat` and `private` visibility equates to a preset of
     * `private_chat`.
     *
     * @var value-of<Preset>|null $preset
     */
    #[Optional(enum: Preset::class)]
    public ?string $preset;

    /**
     * The desired room alias **local part**. If this is included, a
     * room alias will be created and mapped to the newly created
     * room. The alias will belong on the *same* homeserver which
     * created the room. For example, if this was set to "foo" and
     * sent to the homeserver "example.com" the complete room alias
     * would be `#foo:example.com`.
     *
     * The complete room alias will become the canonical alias for
     * the room and an `m.room.canonical_alias` event will be sent
     * into the room.
     */
    #[Optional('room_alias_name')]
    public ?string $roomAliasName;

    /**
     * The room version to set for the room. If not provided, the homeserver is
     * to use its configured default. If provided, the homeserver will return a
     * 400 error with the errcode `M_UNSUPPORTED_ROOM_VERSION` if it does not
     * support the room version.
     */
    #[Optional('room_version')]
    public ?string $roomVersion;

    /**
     * If this is included, an [`m.room.topic`](https://spec.matrix.org/v1.18/client-server-api/#mroomtopic)
     * event with a `text/plain` mimetype will be sent into the room
     * to indicate the topic for the room. This overwrites any
     * [`m.room.topic`](https://spec.matrix.org/v1.18/client-server-api/#mroomtopic) event in `initial_state`.
     */
    #[Optional]
    public ?string $topic;

    /**
     * The room's visibility in the server's
     * [published room directory](https://spec.matrix.org/v1.18/client-server-api#published-room-directory).
     * Defaults to `private`.
     *
     * @var value-of<Visibility>|null $visibility
     */
    #[Optional(enum: Visibility::class)]
    public ?string $visibility;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<InitialState|InitialStateShape>|null $initialState
     * @param list<string>|null $invite
     * @param list<Invite3pid|Invite3pidShape>|null $invite3pid
     * @param Preset|value-of<Preset>|null $preset
     * @param Visibility|value-of<Visibility>|null $visibility
     */
    public static function with(
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
    ): self {
        $self = new self;

        null !== $creationContent && $self['creationContent'] = $creationContent;
        null !== $initialState && $self['initialState'] = $initialState;
        null !== $invite && $self['invite'] = $invite;
        null !== $invite3pid && $self['invite3pid'] = $invite3pid;
        null !== $isDirect && $self['isDirect'] = $isDirect;
        null !== $name && $self['name'] = $name;
        null !== $powerLevelContentOverride && $self['powerLevelContentOverride'] = $powerLevelContentOverride;
        null !== $preset && $self['preset'] = $preset;
        null !== $roomAliasName && $self['roomAliasName'] = $roomAliasName;
        null !== $roomVersion && $self['roomVersion'] = $roomVersion;
        null !== $topic && $self['topic'] = $topic;
        null !== $visibility && $self['visibility'] = $visibility;

        return $self;
    }

    /**
     * Extra keys, such as `m.federate`, to be added to the content
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
     */
    public function withCreationContent(mixed $creationContent): self
    {
        $self = clone $this;
        $self['creationContent'] = $creationContent;

        return $self;
    }

    /**
     * A list of state events to set in the new room. This allows
     * the user to override the default state events set in the new
     * room. The expected format of the state events are an object
     * with type, state_key and content keys set.
     *
     * Takes precedence over events set by `preset`, but gets
     * overridden by `name` and `topic` keys.
     *
     * @param list<InitialState|InitialStateShape> $initialState
     */
    public function withInitialState(array $initialState): self
    {
        $self = clone $this;
        $self['initialState'] = $initialState;

        return $self;
    }

    /**
     * A list of user IDs to invite to the room. This will tell the
     * server to invite everyone in the list to the newly created room.
     *
     * @param list<string> $invite
     */
    public function withInvite(array $invite): self
    {
        $self = clone $this;
        $self['invite'] = $invite;

        return $self;
    }

    /**
     * A list of objects representing third-party IDs to invite into
     * the room.
     *
     * @param list<Invite3pid|Invite3pidShape> $invite3pid
     */
    public function withInvite3pid(array $invite3pid): self
    {
        $self = clone $this;
        $self['invite3pid'] = $invite3pid;

        return $self;
    }

    /**
     * This flag makes the server set the `is_direct` flag on the
     * `m.room.member` events sent to the users in `invite` and
     * `invite_3pid`. See [Direct Messaging](https://spec.matrix.org/v1.18/client-server-api/#direct-messaging) for more information.
     */
    public function withIsDirect(bool $isDirect): self
    {
        $self = clone $this;
        $self['isDirect'] = $isDirect;

        return $self;
    }

    /**
     * If this is included, an [`m.room.name`](https://spec.matrix.org/v1.18/client-server-api/#mroomname) event
     * will be sent into the room to indicate the name for the room.
     * This overwrites any [`m.room.name`](https://spec.matrix.org/v1.18/client-server-api/#mroomname)
     * event in `initial_state`.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The power level content to override in the default power level
     * event. This object is applied on top of the generated
     * [`m.room.power_levels`](https://spec.matrix.org/v1.18/client-server-api/#mroompower_levels)
     * event content prior to it being sent to the room. Defaults to
     * overriding nothing.
     */
    public function withPowerLevelContentOverride(
        mixed $powerLevelContentOverride
    ): self {
        $self = clone $this;
        $self['powerLevelContentOverride'] = $powerLevelContentOverride;

        return $self;
    }

    /**
     * Convenience parameter for setting various default state events
     * based on a preset.
     *
     * If unspecified, the server should use the `visibility` to determine
     * which preset to use. A visibility of `public` equates to a preset of
     * `public_chat` and `private` visibility equates to a preset of
     * `private_chat`.
     *
     * @param Preset|value-of<Preset> $preset
     */
    public function withPreset(Preset|string $preset): self
    {
        $self = clone $this;
        $self['preset'] = $preset;

        return $self;
    }

    /**
     * The desired room alias **local part**. If this is included, a
     * room alias will be created and mapped to the newly created
     * room. The alias will belong on the *same* homeserver which
     * created the room. For example, if this was set to "foo" and
     * sent to the homeserver "example.com" the complete room alias
     * would be `#foo:example.com`.
     *
     * The complete room alias will become the canonical alias for
     * the room and an `m.room.canonical_alias` event will be sent
     * into the room.
     */
    public function withRoomAliasName(string $roomAliasName): self
    {
        $self = clone $this;
        $self['roomAliasName'] = $roomAliasName;

        return $self;
    }

    /**
     * The room version to set for the room. If not provided, the homeserver is
     * to use its configured default. If provided, the homeserver will return a
     * 400 error with the errcode `M_UNSUPPORTED_ROOM_VERSION` if it does not
     * support the room version.
     */
    public function withRoomVersion(string $roomVersion): self
    {
        $self = clone $this;
        $self['roomVersion'] = $roomVersion;

        return $self;
    }

    /**
     * If this is included, an [`m.room.topic`](https://spec.matrix.org/v1.18/client-server-api/#mroomtopic)
     * event with a `text/plain` mimetype will be sent into the room
     * to indicate the topic for the room. This overwrites any
     * [`m.room.topic`](https://spec.matrix.org/v1.18/client-server-api/#mroomtopic) event in `initial_state`.
     */
    public function withTopic(string $topic): self
    {
        $self = clone $this;
        $self['topic'] = $topic;

        return $self;
    }

    /**
     * The room's visibility in the server's
     * [published room directory](https://spec.matrix.org/v1.18/client-server-api#published-room-directory).
     * Defaults to `private`.
     *
     * @param Visibility|value-of<Visibility> $visibility
     */
    public function withVisibility(Visibility|string $visibility): self
    {
        $self = clone $this;
        $self['visibility'] = $visibility;

        return $self;
    }
}
