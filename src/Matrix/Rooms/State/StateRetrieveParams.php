<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\State;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Rooms\State\StateRetrieveParams\Format;

/**
 * Looks up the contents of a state event in a room. If the user is
 * joined to the room then the state is taken from the current
 * state of the room. If the user has left the room then the state is
 * taken from the state of the room when they left.
 *
 * @see BeeperDesktop\Services\Matrix\Rooms\StateService::retrieve()
 *
 * @phpstan-type StateRetrieveParamsShape = array{
 *   roomID: string, eventType: string, format?: null|Format|value-of<Format>
 * }
 */
final class StateRetrieveParams implements BaseModel
{
    /** @use SdkModel<StateRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $roomID;

    #[Required]
    public string $eventType;

    /**
     * The format to use for the returned data. `content` (the default) will
     * return only the content of the state event. `event` will return the entire
     * event in the usual format suitable for clients, including fields like event
     * ID, sender and timestamp.
     *
     * @var value-of<Format>|null $format
     */
    #[Optional(enum: Format::class)]
    public ?string $format;

    /**
     * `new StateRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StateRetrieveParams::with(roomID: ..., eventType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StateRetrieveParams)->withRoomID(...)->withEventType(...)
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
     * @param Format|value-of<Format>|null $format
     */
    public static function with(
        string $roomID,
        string $eventType,
        Format|string|null $format = null
    ): self {
        $self = new self;

        $self['roomID'] = $roomID;
        $self['eventType'] = $eventType;

        null !== $format && $self['format'] = $format;

        return $self;
    }

    public function withRoomID(string $roomID): self
    {
        $self = clone $this;
        $self['roomID'] = $roomID;

        return $self;
    }

    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * The format to use for the returned data. `content` (the default) will
     * return only the content of the state event. `event` will return the entire
     * event in the usual format suitable for clients, including fields like event
     * ID, sender and timestamp.
     *
     * @param Format|value-of<Format> $format
     */
    public function withFormat(Format|string $format): self
    {
        $self = clone $this;
        $self['format'] = $format;

        return $self;
    }
}
