<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Bridges\CookieField\Type;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type CookieFieldShape = array{
 *   id: string, name?: string|null, type?: null|Type|value-of<Type>
 * }
 */
final class CookieField implements BaseModel
{
    /** @use SdkModel<CookieFieldShape> */
    use SdkModel;

    /**
     * Field ID to send back in the fields object.
     */
    #[Required]
    public string $id;

    /**
     * Cookie, header, or local storage key to collect.
     */
    #[Optional]
    public ?string $name;

    /**
     * Browser storage source for this value.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new CookieField()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CookieField::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CookieField)->withID(...)
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
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $id,
        ?string $name = null,
        Type|string|null $type = null
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $name && $self['name'] = $name;
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
     * Cookie, header, or local storage key to collect.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Browser storage source for this value.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
