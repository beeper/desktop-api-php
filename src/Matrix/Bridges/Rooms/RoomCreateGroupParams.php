<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Rooms;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Avatar;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Disappear;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Name;
use BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Topic;

/**
 * Create a group chat on the remote network.
 *
 * @see BeeperDesktop\Services\Matrix\Bridges\RoomsService::createGroup()
 *
 * @phpstan-import-type AvatarShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Avatar
 * @phpstan-import-type DisappearShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Disappear
 * @phpstan-import-type NameShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Name
 * @phpstan-import-type TopicShape from \BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams\Topic
 *
 * @phpstan-type RoomCreateGroupParamsShape = array{
 *   bridgeID: string,
 *   loginID?: string|null,
 *   avatar?: null|Avatar|AvatarShape,
 *   disappear?: null|Disappear|DisappearShape,
 *   name?: null|Name|NameShape,
 *   parent?: mixed,
 *   participants?: list<string>|null,
 *   roomID?: string|null,
 *   topic?: null|Topic|TopicShape,
 *   type?: string|null,
 *   username?: string|null,
 * }
 */
final class RoomCreateGroupParams implements BaseModel
{
    /** @use SdkModel<RoomCreateGroupParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $bridgeID;

    /**
     * An optional explicit login ID to do the action through.
     */
    #[Optional]
    public ?string $loginID;

    /**
     * The `m.room.avatar` event content for the room.
     */
    #[Optional]
    public ?Avatar $avatar;

    /**
     * The `com.beeper.disappearing_timer` event content for the room.
     */
    #[Optional]
    public ?Disappear $disappear;

    /**
     * The `m.room.name` event content for the room.
     */
    #[Optional]
    public ?Name $name;

    #[Optional]
    public mixed $parent;

    /**
     * The users to add to the group initially.
     *
     * @var list<string>|null $participants
     */
    #[Optional(list: 'string')]
    public ?array $participants;

    /**
     * An existing Matrix room ID to bridge to.
     * The other parameters must be already in sync with the room state when using this parameter.
     */
    #[Optional('room_id')]
    public ?string $roomID;

    /**
     * The `m.room.topic` event content for the room.
     */
    #[Optional]
    public ?Topic $topic;

    /**
     * The type of group to create.
     */
    #[Optional]
    public ?string $type;

    /**
     * The public username for the created group.
     */
    #[Optional]
    public ?string $username;

    /**
     * `new RoomCreateGroupParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoomCreateGroupParams::with(bridgeID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoomCreateGroupParams)->withBridgeID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Avatar|AvatarShape|null $avatar
     * @param Disappear|DisappearShape|null $disappear
     * @param Name|NameShape|null $name
     * @param list<string>|null $participants
     * @param Topic|TopicShape|null $topic
     */
    public static function with(
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
    ): self {
        $self = new self;

        $self['bridgeID'] = $bridgeID;

        null !== $loginID && $self['loginID'] = $loginID;
        null !== $avatar && $self['avatar'] = $avatar;
        null !== $disappear && $self['disappear'] = $disappear;
        null !== $name && $self['name'] = $name;
        null !== $parent && $self['parent'] = $parent;
        null !== $participants && $self['participants'] = $participants;
        null !== $roomID && $self['roomID'] = $roomID;
        null !== $topic && $self['topic'] = $topic;
        null !== $type && $self['type'] = $type;
        null !== $username && $self['username'] = $username;

        return $self;
    }

    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }

    /**
     * An optional explicit login ID to do the action through.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }

    /**
     * The `m.room.avatar` event content for the room.
     *
     * @param Avatar|AvatarShape $avatar
     */
    public function withAvatar(Avatar|array $avatar): self
    {
        $self = clone $this;
        $self['avatar'] = $avatar;

        return $self;
    }

    /**
     * The `com.beeper.disappearing_timer` event content for the room.
     *
     * @param Disappear|DisappearShape $disappear
     */
    public function withDisappear(Disappear|array $disappear): self
    {
        $self = clone $this;
        $self['disappear'] = $disappear;

        return $self;
    }

    /**
     * The `m.room.name` event content for the room.
     *
     * @param Name|NameShape $name
     */
    public function withName(Name|array $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withParent(mixed $parent): self
    {
        $self = clone $this;
        $self['parent'] = $parent;

        return $self;
    }

    /**
     * The users to add to the group initially.
     *
     * @param list<string> $participants
     */
    public function withParticipants(array $participants): self
    {
        $self = clone $this;
        $self['participants'] = $participants;

        return $self;
    }

    /**
     * An existing Matrix room ID to bridge to.
     * The other parameters must be already in sync with the room state when using this parameter.
     */
    public function withRoomID(string $roomID): self
    {
        $self = clone $this;
        $self['roomID'] = $roomID;

        return $self;
    }

    /**
     * The `m.room.topic` event content for the room.
     *
     * @param Topic|TopicShape $topic
     */
    public function withTopic(Topic|array $topic): self
    {
        $self = clone $this;
        $self['topic'] = $topic;

        return $self;
    }

    /**
     * The type of group to create.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The public username for the created group.
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
