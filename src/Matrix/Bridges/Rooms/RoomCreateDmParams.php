<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Rooms;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Create a direct chat with a user on the remote network.
 *
 * @see BeeperDesktop\Services\Matrix\Bridges\RoomsService::createDm()
 *
 * @phpstan-type RoomCreateDmParamsShape = array{
 *   bridgeID: string, loginID?: string|null
 * }
 */
final class RoomCreateDmParams implements BaseModel
{
    /** @use SdkModel<RoomCreateDmParamsShape> */
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
     * `new RoomCreateDmParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoomCreateDmParams::with(bridgeID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoomCreateDmParams)->withBridgeID(...)
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
    public static function with(string $bridgeID, ?string $loginID = null): self
    {
        $self = new self;

        $self['bridgeID'] = $bridgeID;

        null !== $loginID && $self['loginID'] = $loginID;

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
}
