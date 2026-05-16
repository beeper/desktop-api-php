<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember2\Cookies;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember2\Cookies\Field\Type;

/**
 * An individual cookie or other stored data item that must be extracted.
 *
 * @phpstan-type FieldShape = array{
 *   name: string,
 *   type: Type|value-of<Type>,
 *   cookieDomain?: string|null,
 *   requestURLRegex?: string|null,
 * }
 */
final class Field implements BaseModel
{
    /** @use SdkModel<FieldShape> */
    use SdkModel;

    /**
     * The name of the item to extract.
     */
    #[Required]
    public string $name;

    /**
     * The type of data to extract.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * For the `cookie` type, the domain of the cookie.
     */
    #[Optional('cookie_domain')]
    public ?string $cookieDomain;

    /**
     * For the `request_header` and `request_body` types, a regex that matches the URLs from which the values can be extracted.
     */
    #[Optional('request_url_regex')]
    public ?string $requestURLRegex;

    /**
     * `new Field()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Field::with(name: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Field)->withName(...)->withType(...)
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
     */
    public static function with(
        string $name,
        Type|string $type,
        ?string $cookieDomain = null,
        ?string $requestURLRegex = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['type'] = $type;

        null !== $cookieDomain && $self['cookieDomain'] = $cookieDomain;
        null !== $requestURLRegex && $self['requestURLRegex'] = $requestURLRegex;

        return $self;
    }

    /**
     * The name of the item to extract.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The type of data to extract.
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
     * For the `cookie` type, the domain of the cookie.
     */
    public function withCookieDomain(string $cookieDomain): self
    {
        $self = clone $this;
        $self['cookieDomain'] = $cookieDomain;

        return $self;
    }

    /**
     * For the `request_header` and `request_body` types, a regex that matches the URLs from which the values can be extracted.
     */
    public function withRequestURLRegex(string $requestURLRegex): self
    {
        $self = clone $this;
        $self['requestURLRegex'] = $requestURLRegex;

        return $self;
    }
}
