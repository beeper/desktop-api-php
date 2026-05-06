<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Capabilities;

use BeeperDesktop\Chats\Chat\Capabilities\DisappearingTimer\Type;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Disappearing-message timer capabilities.
 *
 * @phpstan-type DisappearingTimerShape = array{
 *   omitEmptyTimer?: bool|null,
 *   timers?: list<int>|null,
 *   types?: list<Type|value-of<Type>>|null,
 * }
 */
final class DisappearingTimer implements BaseModel
{
    /** @use SdkModel<DisappearingTimerShape> */
    use SdkModel;

    /**
     * True if empty timer objects should be omitted from message content.
     */
    #[Optional]
    public ?bool $omitEmptyTimer;

    /**
     * Allowed disappearing timer values in milliseconds. Omitted means any timer is allowed.
     *
     * @var list<int>|null $timers
     */
    #[Optional(list: 'int')]
    public ?array $timers;

    /**
     * Supported disappearing timer types.
     *
     * @var list<value-of<Type>>|null $types
     */
    #[Optional(list: Type::class)]
    public ?array $types;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<int>|null $timers
     * @param list<Type|value-of<Type>>|null $types
     */
    public static function with(
        ?bool $omitEmptyTimer = null,
        ?array $timers = null,
        ?array $types = null
    ): self {
        $self = new self;

        null !== $omitEmptyTimer && $self['omitEmptyTimer'] = $omitEmptyTimer;
        null !== $timers && $self['timers'] = $timers;
        null !== $types && $self['types'] = $types;

        return $self;
    }

    /**
     * True if empty timer objects should be omitted from message content.
     */
    public function withOmitEmptyTimer(bool $omitEmptyTimer): self
    {
        $self = clone $this;
        $self['omitEmptyTimer'] = $omitEmptyTimer;

        return $self;
    }

    /**
     * Allowed disappearing timer values in milliseconds. Omitted means any timer is allowed.
     *
     * @param list<int> $timers
     */
    public function withTimers(array $timers): self
    {
        $self = clone $this;
        $self['timers'] = $timers;

        return $self;
    }

    /**
     * Supported disappearing timer types.
     *
     * @param list<Type|value-of<Type>> $types
     */
    public function withTypes(array $types): self
    {
        $self = clone $this;
        $self['types'] = $types;

        return $self;
    }
}
