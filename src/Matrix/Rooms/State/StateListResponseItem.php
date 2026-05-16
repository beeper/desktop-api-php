<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\State;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Rooms\State\StateListResponseItem\Unsigned;

/**
 * The format used for events when they are returned from a homeserver to a client
 * via the Client-Server API, or sent to an Application Service via the Application Services API.
 *
 * @phpstan-import-type UnsignedShape from \BeeperDesktop\Matrix\Rooms\State\StateListResponseItem\Unsigned
 *
 * @phpstan-type StateListResponseItemShape = array{
 *   content: mixed,
 *   eventID: string,
 *   originServerTs: int,
 *   roomID: string,
 *   sender: string,
 *   type: string,
 *   stateKey?: string|null,
 *   unsigned?: null|Unsigned|UnsignedShape,
 * }
 */
final class StateListResponseItem implements BaseModel
{
    /** @use SdkModel<StateListResponseItemShape> */
    use SdkModel;

    /**
     * The body of this event, as created by the client which sent it.
     */
    #[Required]
    public mixed $content;

    /**
     * The globally unique identifier for this event.
     */
    #[Required('event_id')]
    public string $eventID;

    /**
     * Timestamp (in milliseconds since the unix epoch) on originating homeserver
     * when this event was sent.
     */
    #[Required('origin_server_ts')]
    public int $originServerTs;

    /**
     * The ID of the room associated with this event.
     */
    #[Required('room_id')]
    public string $roomID;

    /**
     * Contains the fully-qualified ID of the user who sent this event.
     */
    #[Required]
    public string $sender;

    /**
     * The type of the event.
     */
    #[Required]
    public string $type;

    /**
     * Present if, and only if, this event is a *state* event. The key making
     * this piece of state unique in the room. Note that it is often an empty
     * string.
     *
     * State keys starting with an `@` are reserved for referencing user IDs, such
     * as room members. With the exception of a few events, state events set with a
     * given user's ID as the state key MUST only be set by that user.
     */
    #[Optional('state_key')]
    public ?string $stateKey;

    #[Optional]
    public ?Unsigned $unsigned;

    /**
     * `new StateListResponseItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StateListResponseItem::with(
     *   content: ...,
     *   eventID: ...,
     *   originServerTs: ...,
     *   roomID: ...,
     *   sender: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StateListResponseItem)
     *   ->withContent(...)
     *   ->withEventID(...)
     *   ->withOriginServerTs(...)
     *   ->withRoomID(...)
     *   ->withSender(...)
     *   ->withType(...)
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
     * @param Unsigned|UnsignedShape|null $unsigned
     */
    public static function with(
        mixed $content,
        string $eventID,
        int $originServerTs,
        string $roomID,
        string $sender,
        string $type,
        ?string $stateKey = null,
        Unsigned|array|null $unsigned = null,
    ): self {
        $self = new self;

        $self['content'] = $content;
        $self['eventID'] = $eventID;
        $self['originServerTs'] = $originServerTs;
        $self['roomID'] = $roomID;
        $self['sender'] = $sender;
        $self['type'] = $type;

        null !== $stateKey && $self['stateKey'] = $stateKey;
        null !== $unsigned && $self['unsigned'] = $unsigned;

        return $self;
    }

    /**
     * The body of this event, as created by the client which sent it.
     */
    public function withContent(mixed $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * The globally unique identifier for this event.
     */
    public function withEventID(string $eventID): self
    {
        $self = clone $this;
        $self['eventID'] = $eventID;

        return $self;
    }

    /**
     * Timestamp (in milliseconds since the unix epoch) on originating homeserver
     * when this event was sent.
     */
    public function withOriginServerTs(int $originServerTs): self
    {
        $self = clone $this;
        $self['originServerTs'] = $originServerTs;

        return $self;
    }

    /**
     * The ID of the room associated with this event.
     */
    public function withRoomID(string $roomID): self
    {
        $self = clone $this;
        $self['roomID'] = $roomID;

        return $self;
    }

    /**
     * Contains the fully-qualified ID of the user who sent this event.
     */
    public function withSender(string $sender): self
    {
        $self = clone $this;
        $self['sender'] = $sender;

        return $self;
    }

    /**
     * The type of the event.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Present if, and only if, this event is a *state* event. The key making
     * this piece of state unique in the room. Note that it is often an empty
     * string.
     *
     * State keys starting with an `@` are reserved for referencing user IDs, such
     * as room members. With the exception of a few events, state events set with a
     * given user's ID as the state key MUST only be set by that user.
     */
    public function withStateKey(string $stateKey): self
    {
        $self = clone $this;
        $self['stateKey'] = $stateKey;

        return $self;
    }

    /**
     * @param Unsigned|UnsignedShape $unsigned
     */
    public function withUnsigned(Unsigned|array $unsigned): self
    {
        $self = clone $this;
        $self['unsigned'] = $unsigned;

        return $self;
    }
}
