<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * The `com.beeper.disappearing_timer` event content for the room.
 *
 * @phpstan-type DisappearShape = array{timer?: float|null, type?: string|null}
 */
final class Disappear implements BaseModel
{
    /** @use SdkModel<DisappearShape> */
    use SdkModel;

    #[Optional]
    public ?float $timer;

    #[Optional]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $timer = null, ?string $type = null): self
    {
        $self = new self;

        null !== $timer && $self['timer'] = $timer;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    public function withTimer(float $timer): self
    {
        $self = clone $this;
        $self['timer'] = $timer;

        return $self;
    }

    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
