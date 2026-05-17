<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Capabilities;

use BeeperDesktop\Chats\Chat\Capabilities\Attachment\Caption;
use BeeperDesktop\Chats\Chat\Capabilities\Attachment\MimeType;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Capabilities for one attachment message type.
 *
 * @phpstan-type AttachmentShape = array{
 *   mimeTypes: array<string,MimeType|value-of<MimeType>>,
 *   caption?: null|Caption|value-of<Caption>,
 *   maxCaptionLength?: int|null,
 *   maxDuration?: int|null,
 *   maxHeight?: int|null,
 *   maxSize?: int|null,
 *   maxWidth?: int|null,
 *   viewOnce?: bool|null,
 * }
 */
final class Attachment implements BaseModel
{
    /** @use SdkModel<AttachmentShape> */
    use SdkModel;

    /**
     * Supported MIME types or MIME patterns for this file message type. Missing MIME types should be treated as rejected.
     *
     * @var array<string,value-of<MimeType>> $mimeTypes
     */
    #[Required(map: MimeType::class)]
    public array $mimeTypes;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Caption>|null $caption
     */
    #[Optional(enum: Caption::class)]
    public ?int $caption;

    /**
     * Maximum caption length when captions are supported.
     */
    #[Optional]
    public ?int $maxCaptionLength;

    /**
     * Maximum audio or video duration in seconds.
     */
    #[Optional]
    public ?int $maxDuration;

    /**
     * Maximum image or video height in pixels.
     */
    #[Optional]
    public ?int $maxHeight;

    /**
     * Maximum file size in bytes.
     */
    #[Optional]
    public ?int $maxSize;

    /**
     * Maximum image or video width in pixels.
     */
    #[Optional]
    public ?int $maxWidth;

    /**
     * True if this file type can be sent as view-once media.
     */
    #[Optional]
    public ?bool $viewOnce;

    /**
     * `new Attachment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Attachment::with(mimeTypes: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Attachment)->withMimeTypes(...)
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
     * @param array<string,MimeType|value-of<MimeType>> $mimeTypes
     * @param Caption|value-of<Caption>|null $caption
     */
    public static function with(
        array $mimeTypes,
        Caption|int|null $caption = null,
        ?int $maxCaptionLength = null,
        ?int $maxDuration = null,
        ?int $maxHeight = null,
        ?int $maxSize = null,
        ?int $maxWidth = null,
        ?bool $viewOnce = null,
    ): self {
        $self = new self;

        $self['mimeTypes'] = $mimeTypes;

        null !== $caption && $self['caption'] = $caption;
        null !== $maxCaptionLength && $self['maxCaptionLength'] = $maxCaptionLength;
        null !== $maxDuration && $self['maxDuration'] = $maxDuration;
        null !== $maxHeight && $self['maxHeight'] = $maxHeight;
        null !== $maxSize && $self['maxSize'] = $maxSize;
        null !== $maxWidth && $self['maxWidth'] = $maxWidth;
        null !== $viewOnce && $self['viewOnce'] = $viewOnce;

        return $self;
    }

    /**
     * Supported MIME types or MIME patterns for this file message type. Missing MIME types should be treated as rejected.
     *
     * @param array<string,MimeType|value-of<MimeType>> $mimeTypes
     */
    public function withMimeTypes(array $mimeTypes): self
    {
        $self = clone $this;
        $self['mimeTypes'] = $mimeTypes;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Caption|value-of<Caption> $caption
     */
    public function withCaption(Caption|int $caption): self
    {
        $self = clone $this;
        $self['caption'] = $caption;

        return $self;
    }

    /**
     * Maximum caption length when captions are supported.
     */
    public function withMaxCaptionLength(int $maxCaptionLength): self
    {
        $self = clone $this;
        $self['maxCaptionLength'] = $maxCaptionLength;

        return $self;
    }

    /**
     * Maximum audio or video duration in seconds.
     */
    public function withMaxDuration(int $maxDuration): self
    {
        $self = clone $this;
        $self['maxDuration'] = $maxDuration;

        return $self;
    }

    /**
     * Maximum image or video height in pixels.
     */
    public function withMaxHeight(int $maxHeight): self
    {
        $self = clone $this;
        $self['maxHeight'] = $maxHeight;

        return $self;
    }

    /**
     * Maximum file size in bytes.
     */
    public function withMaxSize(int $maxSize): self
    {
        $self = clone $this;
        $self['maxSize'] = $maxSize;

        return $self;
    }

    /**
     * Maximum image or video width in pixels.
     */
    public function withMaxWidth(int $maxWidth): self
    {
        $self = clone $this;
        $self['maxWidth'] = $maxWidth;

        return $self;
    }

    /**
     * True if this file type can be sent as view-once media.
     */
    public function withViewOnce(bool $viewOnce): self
    {
        $self = clone $this;
        $self['viewOnce'] = $viewOnce;

        return $self;
    }
}
