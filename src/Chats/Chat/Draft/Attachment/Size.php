<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Draft\Attachment;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Pixel dimensions of the attachment.
 *
 * @phpstan-type SizeShape = array{height?: float|null, width?: float|null}
 */
final class Size implements BaseModel
{
    /** @use SdkModel<SizeShape> */
    use SdkModel;

    #[Optional]
    public ?float $height;

    #[Optional]
    public ?float $width;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?float $height = null, ?float $width = null): self
    {
        $self = new self;

        null !== $height && $self['height'] = $height;
        null !== $width && $self['width'] = $width;

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
