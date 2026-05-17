<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Bridges\DisappearingTimerCapability\Type;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Disappearing-message timer capability.
 *
 * @phpstan-type DisappearingTimerCapabilityShape = array{
 *   types: list<Type|value-of<Type>>,
 *   omitEmptyTimer?: bool|null,
 *   timers?: list<int>|null,
 * }
 */
final class DisappearingTimerCapability implements BaseModel
{
    /** @use SdkModel<DisappearingTimerCapabilityShape> */
    use SdkModel;

    /** @var list<value-of<Type>> $types */
    #[Required(list: Type::class)]
    public array $types;

    #[Optional('omit_empty_timer')]
    public ?bool $omitEmptyTimer;

    /** @var list<int>|null $timers */
    #[Optional(list: 'int')]
    public ?array $timers;

    /**
     * `new DisappearingTimerCapability()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisappearingTimerCapability::with(types: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisappearingTimerCapability)->withTypes(...)
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
     * @param list<Type|value-of<Type>> $types
     * @param list<int>|null $timers
     */
    public static function with(
        array $types,
        ?bool $omitEmptyTimer = null,
        ?array $timers = null
    ): self {
        $self = new self;

        $self['types'] = $types;

        null !== $omitEmptyTimer && $self['omitEmptyTimer'] = $omitEmptyTimer;
        null !== $timers && $self['timers'] = $timers;

        return $self;
    }

    /**
     * @param list<Type|value-of<Type>> $types
     */
    public function withTypes(array $types): self
    {
        $self = clone $this;
        $self['types'] = $types;

        return $self;
    }

    public function withOmitEmptyTimer(bool $omitEmptyTimer): self
    {
        $self = clone $this;
        $self['omitEmptyTimer'] = $omitEmptyTimer;

        return $self;
    }

    /**
     * @param list<int> $timers
     */
    public function withTimers(array $timers): self
    {
        $self = clone $this;
        $self['timers'] = $timers;

        return $self;
    }
}
