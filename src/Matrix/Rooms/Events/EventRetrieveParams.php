<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\Events;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Get a single event based on `roomId/eventId`. You must have permission to
 * retrieve this event e.g. by being a member in the room for this event.
 *
 * @see BeeperDesktop\Services\Matrix\Rooms\EventsService::retrieve()
 *
 * @phpstan-type EventRetrieveParamsShape = array{roomID: string}
 */
final class EventRetrieveParams implements BaseModel
{
    /** @use SdkModel<EventRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $roomID;

    /**
     * `new EventRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EventRetrieveParams::with(roomID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EventRetrieveParams)->withRoomID(...)
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
     */
    public static function with(string $roomID): self
    {
        $self = new self;

        $self['roomID'] = $roomID;

        return $self;
    }

    public function withRoomID(string $roomID): self
    {
        $self = clone $this;
        $self['roomID'] = $roomID;

        return $self;
    }
}
