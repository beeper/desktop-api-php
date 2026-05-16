<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWaitForStepResponse\UnionMember1\UserInput\Attachment;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Optional but recommended metadata for the attachment. Can generally be derived from the raw content if omitted.
 *
 * @phpstan-type InfoShape = array{
 *   h?: float|null, mimetype?: string|null, size?: float|null, w?: float|null
 * }
 */
final class Info implements BaseModel
{
    /** @use SdkModel<InfoShape> */
    use SdkModel;

    /**
     * The height of the media in pixels. Only applicable for images and videos.
     */
    #[Optional]
    public ?float $h;

    /**
     * The MIME type for the media content.
     */
    #[Optional]
    public ?string $mimetype;

    /**
     * The size of the media content in number of bytes. Strongly recommended to include.
     */
    #[Optional]
    public ?float $size;

    /**
     * The width of the media in pixels. Only applicable for images and videos.
     */
    #[Optional]
    public ?float $w;

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
        ?float $h = null,
        ?string $mimetype = null,
        ?float $size = null,
        ?float $w = null,
    ): self {
        $self = new self;

        null !== $h && $self['h'] = $h;
        null !== $mimetype && $self['mimetype'] = $mimetype;
        null !== $size && $self['size'] = $size;
        null !== $w && $self['w'] = $w;

        return $self;
    }

    /**
     * The height of the media in pixels. Only applicable for images and videos.
     */
    public function withH(float $h): self
    {
        $self = clone $this;
        $self['h'] = $h;

        return $self;
    }

    /**
     * The MIME type for the media content.
     */
    public function withMimetype(string $mimetype): self
    {
        $self = clone $this;
        $self['mimetype'] = $mimetype;

        return $self;
    }

    /**
     * The size of the media content in number of bytes. Strongly recommended to include.
     */
    public function withSize(float $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * The width of the media in pixels. Only applicable for images and videos.
     */
    public function withW(float $w): self
    {
        $self = clone $this;
        $self['w'] = $w;

        return $self;
    }
}
