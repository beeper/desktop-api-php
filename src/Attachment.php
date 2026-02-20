<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Attachment\Size;
use BeeperDesktop\Attachment\Type;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SizeShape from \BeeperDesktop\Attachment\Size
 *
 * @phpstan-type AttachmentShape = array{
 *   type: Type|value-of<Type>,
 *   id?: string|null,
 *   duration?: float|null,
 *   fileName?: string|null,
 *   fileSize?: float|null,
 *   isGif?: bool|null,
 *   isSticker?: bool|null,
 *   isVoiceNote?: bool|null,
 *   mimeType?: string|null,
 *   posterImg?: string|null,
 *   size?: null|Size|SizeShape,
 *   srcURL?: string|null,
 * }
 */
final class Attachment implements BaseModel
{
    /** @use SdkModel<AttachmentShape> */
    use SdkModel;

    /**
     * Attachment type.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Attachment identifier (typically an mxc:// URL). Use with /v1/assets/download to get a local file path.
     */
    #[Optional]
    public ?string $id;

    /**
     * Duration in seconds (audio/video).
     */
    #[Optional]
    public ?float $duration;

    /**
     * Original filename if available.
     */
    #[Optional]
    public ?string $fileName;

    /**
     * File size in bytes if known.
     */
    #[Optional]
    public ?float $fileSize;

    /**
     * True if the attachment is a GIF.
     */
    #[Optional]
    public ?bool $isGif;

    /**
     * True if the attachment is a sticker.
     */
    #[Optional]
    public ?bool $isSticker;

    /**
     * True if the attachment is a voice note.
     */
    #[Optional]
    public ?bool $isVoiceNote;

    /**
     * MIME type if known (e.g., 'image/png').
     */
    #[Optional]
    public ?string $mimeType;

    /**
     * Preview image URL for video attachments (poster frame). May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    #[Optional]
    public ?string $posterImg;

    /**
     * Pixel dimensions of the attachment: width/height in px.
     */
    #[Optional]
    public ?Size $size;

    /**
     * Public URL or local file path to fetch the asset. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    #[Optional]
    public ?string $srcURL;

    /**
     * `new Attachment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Attachment::with(type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Attachment)->withType(...)
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
     * @param Size|SizeShape|null $size
     */
    public static function with(
        Type|string $type,
        ?string $id = null,
        ?float $duration = null,
        ?string $fileName = null,
        ?float $fileSize = null,
        ?bool $isGif = null,
        ?bool $isSticker = null,
        ?bool $isVoiceNote = null,
        ?string $mimeType = null,
        ?string $posterImg = null,
        Size|array|null $size = null,
        ?string $srcURL = null,
    ): self {
        $self = new self;

        $self['type'] = $type;

        null !== $id && $self['id'] = $id;
        null !== $duration && $self['duration'] = $duration;
        null !== $fileName && $self['fileName'] = $fileName;
        null !== $fileSize && $self['fileSize'] = $fileSize;
        null !== $isGif && $self['isGif'] = $isGif;
        null !== $isSticker && $self['isSticker'] = $isSticker;
        null !== $isVoiceNote && $self['isVoiceNote'] = $isVoiceNote;
        null !== $mimeType && $self['mimeType'] = $mimeType;
        null !== $posterImg && $self['posterImg'] = $posterImg;
        null !== $size && $self['size'] = $size;
        null !== $srcURL && $self['srcURL'] = $srcURL;

        return $self;
    }

    /**
     * Attachment type.
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
     * Attachment identifier (typically an mxc:// URL). Use with /v1/assets/download to get a local file path.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Duration in seconds (audio/video).
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Original filename if available.
     */
    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    /**
     * File size in bytes if known.
     */
    public function withFileSize(float $fileSize): self
    {
        $self = clone $this;
        $self['fileSize'] = $fileSize;

        return $self;
    }

    /**
     * True if the attachment is a GIF.
     */
    public function withIsGif(bool $isGif): self
    {
        $self = clone $this;
        $self['isGif'] = $isGif;

        return $self;
    }

    /**
     * True if the attachment is a sticker.
     */
    public function withIsSticker(bool $isSticker): self
    {
        $self = clone $this;
        $self['isSticker'] = $isSticker;

        return $self;
    }

    /**
     * True if the attachment is a voice note.
     */
    public function withIsVoiceNote(bool $isVoiceNote): self
    {
        $self = clone $this;
        $self['isVoiceNote'] = $isVoiceNote;

        return $self;
    }

    /**
     * MIME type if known (e.g., 'image/png').
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * Preview image URL for video attachments (poster frame). May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    public function withPosterImg(string $posterImg): self
    {
        $self = clone $this;
        $self['posterImg'] = $posterImg;

        return $self;
    }

    /**
     * Pixel dimensions of the attachment: width/height in px.
     *
     * @param Size|SizeShape $size
     */
    public function withSize(Size|array $size): self
    {
        $self = clone $this;
        $self['size'] = $size;

        return $self;
    }

    /**
     * Public URL or local file path to fetch the asset. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    public function withSrcURL(string $srcURL): self
    {
        $self = clone $this;
        $self['srcURL'] = $srcURL;

        return $self;
    }
}
