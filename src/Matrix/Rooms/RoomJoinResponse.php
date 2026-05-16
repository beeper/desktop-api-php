<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type RoomJoinResponseShape = array{roomID: string}
 */
final class RoomJoinResponse implements BaseModel
{
    /** @use SdkModel<RoomJoinResponseShape> */
    use SdkModel;

    /**
     * The joined room ID.
     */
    #[Required('room_id')]
    public string $roomID;

    /**
     * `new RoomJoinResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoomJoinResponse::with(roomID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoomJoinResponse)->withRoomID(...)
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
     * The joined room ID.
     */
    public function withRoomID(string $roomID): self
    {
        $self = clone $this;
        $self['roomID'] = $roomID;

        return $self;
    }
}
