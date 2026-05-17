<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Group creation field capability.
 *
 * @phpstan-import-type DisappearingTimerCapabilityShape from \BeeperDesktop\Bridges\DisappearingTimerCapability
 *
 * @phpstan-type GroupFieldCapabilityShape = array{
 *   allowed: bool,
 *   maxLength?: int|null,
 *   minLength?: int|null,
 *   required?: bool|null,
 *   settings?: null|DisappearingTimerCapability|DisappearingTimerCapabilityShape,
 * }
 */
final class GroupFieldCapability implements BaseModel
{
    /** @use SdkModel<GroupFieldCapabilityShape> */
    use SdkModel;

    #[Required]
    public bool $allowed;

    #[Optional('max_length')]
    public ?int $maxLength;

    #[Optional('min_length')]
    public ?int $minLength;

    #[Optional]
    public ?bool $required;

    /**
     * Disappearing-message timer capability.
     */
    #[Optional]
    public ?DisappearingTimerCapability $settings;

    /**
     * `new GroupFieldCapability()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GroupFieldCapability::with(allowed: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GroupFieldCapability)->withAllowed(...)
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
     * @param DisappearingTimerCapability|DisappearingTimerCapabilityShape|null $settings
     */
    public static function with(
        bool $allowed,
        ?int $maxLength = null,
        ?int $minLength = null,
        ?bool $required = null,
        DisappearingTimerCapability|array|null $settings = null,
    ): self {
        $self = new self;

        $self['allowed'] = $allowed;

        null !== $maxLength && $self['maxLength'] = $maxLength;
        null !== $minLength && $self['minLength'] = $minLength;
        null !== $required && $self['required'] = $required;
        null !== $settings && $self['settings'] = $settings;

        return $self;
    }

    public function withAllowed(bool $allowed): self
    {
        $self = clone $this;
        $self['allowed'] = $allowed;

        return $self;
    }

    public function withMaxLength(int $maxLength): self
    {
        $self = clone $this;
        $self['maxLength'] = $maxLength;

        return $self;
    }

    public function withMinLength(int $minLength): self
    {
        $self = clone $this;
        $self['minLength'] = $minLength;

        return $self;
    }

    public function withRequired(bool $required): self
    {
        $self = clone $this;
        $self['required'] = $required;

        return $self;
    }

    /**
     * Disappearing-message timer capability.
     *
     * @param DisappearingTimerCapability|DisappearingTimerCapabilityShape $settings
     */
    public function withSettings(
        DisappearingTimerCapability|array $settings
    ): self {
        $self = clone $this;
        $self['settings'] = $settings;

        return $self;
    }
}
