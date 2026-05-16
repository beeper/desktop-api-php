<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Information about the newly created room.
 *
 * @phpstan-type RoomNewResponseShape = array{roomID: string}
 */
final class RoomNewResponse implements BaseModel
{
    /** @use SdkModel<RoomNewResponseShape> */
    use SdkModel;

    /**
     * The created room's ID.
     */
    #[Required('room_id')]
    public string $roomID;

    /**
     * `new RoomNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoomNewResponse::with(roomID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoomNewResponse)->withRoomID(...)
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

    /**
     * The created room's ID.
     */
    public function withRoomID(string $roomID): self
    {
        $self = clone $this;
        $self['roomID'] = $roomID;

        return $self;
    }
}
