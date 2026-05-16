<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember0;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember0\DisplayAndWait\Type;

/**
 * Parameters for the display and wait login step.
 *
 * @phpstan-type DisplayAndWaitShape = array{
 *   type: Type|value-of<Type>, data?: string|null, imageURL?: string|null
 * }
 */
final class DisplayAndWait implements BaseModel
{
    /** @use SdkModel<DisplayAndWaitShape> */
    use SdkModel;

    /**
     * The type of thing to display.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * The thing to display (raw data for QR, unicode emoji for emoji, plain string for code).
     */
    #[Optional]
    public ?string $data;

    /**
     * An image containing the thing to display. If present, this is recommended over using data directly. For emojis, the URL to the canonical image representation of the emoji.
     */
    #[Optional('image_url')]
    public ?string $imageURL;

    /**
     * `new DisplayAndWait()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DisplayAndWait::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DisplayAndWait)->withType(...)
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
        Type|string $type,
        ?string $data = null,
        ?string $imageURL = null
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $data && $self['data'] = $data;
        null !== $imageURL && $self['imageURL'] = $imageURL;

        return $self;
    }

    /**
     * The type of thing to display.
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
     * The thing to display (raw data for QR, unicode emoji for emoji, plain string for code).
     */
    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * An image containing the thing to display. If present, this is recommended over using data directly. For emojis, the URL to the canonical image representation of the emoji.
     */
    public function withImageURL(string $imageURL): self
    {
        $self = clone $this;
        $self['imageURL'] = $imageURL;

        return $self;
    }
}
