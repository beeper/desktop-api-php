<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * The `m.room.name` event content for the room.
 *
 * @phpstan-type NameShape = array{name?: string|null}
 */
final class Name implements BaseModel
{
    /** @use SdkModel<NameShape> */
    use SdkModel;

    #[Optional]
    public ?string $name;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $name = null): self
    {
        $self = new self;

        null !== $name && $self['name'] = $name;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
