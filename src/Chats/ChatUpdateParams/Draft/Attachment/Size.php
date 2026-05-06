<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatUpdateParams\Draft\Attachment;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Dimensions (optional override of cached value).
 *
 * @phpstan-type SizeShape = array{height: float, width: float}
 */
final class Size implements BaseModel
{
    /** @use SdkModel<SizeShape> */
    use SdkModel;

    #[Required]
    public float $height;

    #[Required]
    public float $width;

    /**
     * `new Size()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Size::with(height: ..., width: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Size)->withHeight(...)->withWidth(...)
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
    public static function with(float $height, float $width): self
    {
        $self = new self;

        $self['height'] = $height;
        $self['width'] = $width;

        return $self;
    }

    public function withHeight(float $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    public function withWidth(float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
