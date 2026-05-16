<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Rooms;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * A successfully created group chat.
 *
 * @phpstan-type RoomNewGroupResponseShape = array{id: string, mxid: string}
 */
final class RoomNewGroupResponse implements BaseModel
{
    /** @use SdkModel<RoomNewGroupResponseShape> */
    use SdkModel;

    /**
     * The internal chat ID of the created group.
     */
    #[Required]
    public string $id;

    /**
     * The Matrix room ID of the portal.
     */
    #[Required]
    public string $mxid;

    /**
     * `new RoomNewGroupResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoomNewGroupResponse::with(id: ..., mxid: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoomNewGroupResponse)->withID(...)->withMxid(...)
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
    public static function with(string $id, string $mxid): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['mxid'] = $mxid;

        return $self;
    }

    /**
     * The internal chat ID of the created group.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The Matrix room ID of the portal.
     */
    public function withMxid(string $mxid): self
    {
        $self = clone $this;
        $self['mxid'] = $mxid;

        return $self;
    }
}
