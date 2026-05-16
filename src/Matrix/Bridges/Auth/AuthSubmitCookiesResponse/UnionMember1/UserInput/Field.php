<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember1\UserInput;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember1\UserInput\Field\Type;

/**
 * A field that the user can fill.
 *
 * @phpstan-type FieldShape = array{
 *   id: string,
 *   name: string,
 *   type: Type|value-of<Type>,
 *   defaultValue?: string|null,
 *   description?: string|null,
 *   options?: list<string>|null,
 *   pattern?: string|null,
 * }
 */
final class Field implements BaseModel
{
    /** @use SdkModel<FieldShape> */
    use SdkModel;

    /**
     * The internal ID of the field. This must be used as the key in the object when submitting the data back to the bridge.
     */
    #[Required]
    public string $id;

    /**
     * The name of the field shown to the user.
     */
    #[Required]
    public string $name;

    /**
     * The type of field.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * A default value that the client can pre-fill the field with.
     */
    #[Optional('default_value')]
    public ?string $defaultValue;

    /**
     * A more detailed description of the field shown to the user.
     */
    #[Optional]
    public ?string $description;

    /**
     * For fields of type select, the valid options.
     *
     * @var list<string>|null $options
     */
    #[Optional(list: 'string')]
    public ?array $options;

    /**
     * A regular expression that the field value must match.
     */
    #[Optional]
    public ?string $pattern;

    /**
     * `new Field()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Field::with(id: ..., name: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Field)->withID(...)->withName(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     * @param list<string>|null $options
     */
    public static function with(
        string $id,
        string $name,
        Type|string $type,
        ?string $defaultValue = null,
        ?string $description = null,
        ?array $options = null,
        ?string $pattern = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['name'] = $name;
        $self['type'] = $type;

        null !== $defaultValue && $self['defaultValue'] = $defaultValue;
        null !== $description && $self['description'] = $description;
        null !== $options && $self['options'] = $options;
        null !== $pattern && $self['pattern'] = $pattern;

        return $self;
    }

    /**
     * The internal ID of the field. This must be used as the key in the object when submitting the data back to the bridge.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The name of the field shown to the user.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The type of field.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * A default value that the client can pre-fill the field with.
     */
    public function withDefaultValue(string $defaultValue): self
    {
        $self = clone $this;
        $self['defaultValue'] = $defaultValue;

        return $self;
    }

    /**
     * A more detailed description of the field shown to the user.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * For fields of type select, the valid options.
     *
     * @param list<string> $options
     */
    public function withOptions(array $options): self
    {
        $self = clone $this;
        $self['options'] = $options;

        return $self;
    }

    /**
     * A regular expression that the field value must match.
     */
    public function withPattern(string $pattern): self
    {
        $self = clone $this;
        $self['pattern'] = $pattern;

        return $self;
    }
}
