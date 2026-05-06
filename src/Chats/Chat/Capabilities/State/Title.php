<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Capabilities\State;

use BeeperDesktop\Chats\Chat\Capabilities\State\Title\Level;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Chat title state capability.
 *
 * @phpstan-type TitleShape = array{level: Level|value-of<Level>}
 */
final class Title implements BaseModel
{
    /** @use SdkModel<TitleShape> */
    use SdkModel;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Level> $level
     */
    #[Required(enum: Level::class)]
    public int $level;

    /**
     * `new Title()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Title::with(level: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Title)->withLevel(...)
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
     *
     * @param Level|value-of<Level> $level
     */
    public static function with(Level|int $level): self
    {
        $self = new self;

        $self['level'] = $level;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|int $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }
}
