<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
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
 * @see BeeperDesktop\Services\Matrix\RoomsService::leave()
 *
 * @phpstan-type RoomLeaveParamsShape = array{reason?: string|null}
 */
final class RoomLeaveParams implements BaseModel
{
    /** @use SdkModel<RoomLeaveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional reason to be included as the `reason` on the subsequent
     * membership event.
     */
    #[Optional]
    public ?string $reason;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $reason = null): self
    {
        $self = new self;

        null !== $reason && $self['reason'] = $reason;

        return $self;
    }

    /**
     * Optional reason to be included as the `reason` on the subsequent
     * membership event.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }
}
