<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Rooms\RoomJoinParams\ThirdPartySigned;

/**
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
 * @see BeeperDesktop\Services\Matrix\RoomsService::join()
 *
 * @phpstan-import-type ThirdPartySignedShape from \BeeperDesktop\Matrix\Rooms\RoomJoinParams\ThirdPartySigned
 *
 * @phpstan-type RoomJoinParamsShape = array{
 *   via?: list<string>|null,
 *   reason?: string|null,
 *   thirdPartySigned?: null|ThirdPartySigned|ThirdPartySignedShape,
 * }
 */
final class RoomJoinParams implements BaseModel
{
    /** @use SdkModel<RoomJoinParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The servers to attempt to join the room through. One of the servers
     * must be participating in the room.
     *
     * @var list<string>|null $via
     */
    #[Optional(list: 'string')]
    public ?array $via;

    /**
     * Optional reason to be included as the `reason` on the subsequent
     * membership event.
     */
    #[Optional]
    public ?string $reason;

    /**
     * A signature of an `m.third_party_invite` token to prove that this user
     * owns a third-party identity which has been invited to the room.
     */
    #[Optional('third_party_signed')]
    public ?ThirdPartySigned $thirdPartySigned;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $via
     * @param ThirdPartySigned|ThirdPartySignedShape|null $thirdPartySigned
     */
    public static function with(
        ?array $via = null,
        ?string $reason = null,
        ThirdPartySigned|array|null $thirdPartySigned = null,
    ): self {
        $self = new self;

        null !== $via && $self['via'] = $via;
        null !== $reason && $self['reason'] = $reason;
        null !== $thirdPartySigned && $self['thirdPartySigned'] = $thirdPartySigned;

        return $self;
    }

    /**
     * The servers to attempt to join the room through. One of the servers
     * must be participating in the room.
     *
     * @param list<string> $via
     */
    public function withVia(array $via): self
    {
        $self = clone $this;
        $self['via'] = $via;

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

    /**
     * A signature of an `m.third_party_invite` token to prove that this user
     * owns a third-party identity which has been invited to the room.
     *
     * @param ThirdPartySigned|ThirdPartySignedShape $thirdPartySigned
     */
    public function withThirdPartySigned(
        ThirdPartySigned|array $thirdPartySigned
    ): self {
        $self = clone $this;
        $self['thirdPartySigned'] = $thirdPartySigned;

        return $self;
    }
}
