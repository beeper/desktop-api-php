<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * The `m.room.avatar` event content for the room.
 *
 * @phpstan-type AvatarShape = array{url?: string|null}
 */
final class Avatar implements BaseModel
{
    /** @use SdkModel<AvatarShape> */
    use SdkModel;

    #[Optional]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $url = null): self
    {
        $self = new self;

        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
