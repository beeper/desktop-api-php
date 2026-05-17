<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type LoginInputFieldShape = array{
 *   id: string,
 *   initialValue?: string|null,
 *   label?: string|null,
 *   optional?: bool|null,
 *   placeholder?: string|null,
 *   type?: string|null,
 * }
 */
final class LoginInputField implements BaseModel
{
    /** @use SdkModel<LoginInputFieldShape> */
    use SdkModel;

    /**
     * Field ID to send back in the fields object.
     */
    #[Required]
    public string $id;

    /**
     * Initial field value, when provided by the network.
     */
    #[Optional]
    public ?string $initialValue;

    /**
     * Field label to show to the user.
     */
    #[Optional]
    public ?string $label;

    /**
     * True if the user can leave this field empty.
     */
    #[Optional]
    public ?bool $optional;

    /**
     * Placeholder text to show when the field is empty.
     */
    #[Optional]
    public ?string $placeholder;

    /**
     * Suggested input type, such as text, password, or email.
     */
    #[Optional]
    public ?string $type;

    /**
     * `new LoginInputField()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginInputField::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginInputField)->withID(...)
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
    public static function with(
        string $id,
        ?string $initialValue = null,
        ?string $label = null,
        ?bool $optional = null,
        ?string $placeholder = null,
        ?string $type = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $initialValue && $self['initialValue'] = $initialValue;
        null !== $label && $self['label'] = $label;
        null !== $optional && $self['optional'] = $optional;
        null !== $placeholder && $self['placeholder'] = $placeholder;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Field ID to send back in the fields object.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Initial field value, when provided by the network.
     */
    public function withInitialValue(string $initialValue): self
    {
        $self = clone $this;
        $self['initialValue'] = $initialValue;

        return $self;
    }

    /**
     * Field label to show to the user.
     */
    public function withLabel(string $label): self
    {
        $self = clone $this;
        $self['label'] = $label;

        return $self;
    }

    /**
     * True if the user can leave this field empty.
     */
    public function withOptional(bool $optional): self
    {
        $self = clone $this;
        $self['optional'] = $optional;

        return $self;
    }

    /**
     * Placeholder text to show when the field is empty.
     */
    public function withPlaceholder(string $placeholder): self
    {
        $self = clone $this;
        $self['placeholder'] = $placeholder;

        return $self;
    }

    /**
     * Suggested input type, such as text, password, or email.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
