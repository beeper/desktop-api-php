<?php

declare(strict_types=1);

namespace BeeperDesktop\Shared;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Shared\Attachment\Size;
use BeeperDesktop\Shared\Attachment\Type;

final class Attachment implements BaseModel
{
    use SdkModel;

    /**
     * Attachment type.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Duration in seconds (audio/video).
     */
    #[Api(optional: true)]
    public ?float $duration;

    /**
     * Original filename if available.
     */
    #[Api(optional: true)]
    public ?string $fileName;

    /**
     * File size in bytes if known.
     */
    #[Api(optional: true)]
    public ?float $fileSize;

    /**
     * True if the attachment is a GIF.
     */
    #[Api(optional: true)]
    public ?bool $isGif;

    /**
     * True if the attachment is a sticker.
     */
    #[Api(optional: true)]
    public ?bool $isSticker;

    /**
     * True if the attachment is a voice note.
     */
    #[Api(optional: true)]
    public ?bool $isVoiceNote;

    /**
     * MIME type if known (e.g., 'image/png').
     */
    #[Api(optional: true)]
    public ?string $mimeType;

    /**
     * Preview image URL for video attachments (poster frame). May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    #[Api(optional: true)]
    public ?string $posterImg;

    /**
     * Pixel dimensions of the attachment: width/height in px.
     */
    #[Api(optional: true)]
    public ?Size $size;

    /**
     * Public URL or local file path to fetch the asset. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    #[Api(optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type::* $type
     */
    public static function with(
        string $type,
        ?float $duration = null,
        ?string $fileName = null,
        ?float $fileSize = null,
        ?bool $isGif = null,
        ?bool $isSticker = null,
        ?bool $isVoiceNote = null,
        ?string $mimeType = null,
        ?string $posterImg = null,
        ?Size $size = null,
        ?string $srcURL = null,
    ): self {
        $obj = new self;

        $obj->type = $type;

        null !== $duration && $obj->duration = $duration;
        null !== $fileName && $obj->fileName = $fileName;
        null !== $fileSize && $obj->fileSize = $fileSize;
        null !== $isGif && $obj->isGif = $isGif;
        null !== $isSticker && $obj->isSticker = $isSticker;
        null !== $isVoiceNote && $obj->isVoiceNote = $isVoiceNote;
        null !== $mimeType && $obj->mimeType = $mimeType;
        null !== $posterImg && $obj->posterImg = $posterImg;
        null !== $size && $obj->size = $size;
        null !== $srcURL && $obj->srcURL = $srcURL;

        return $obj;
    }

    /**
     * Attachment type.
     *
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Duration in seconds (audio/video).
     */
    public function withDuration(float $duration): self
    {
        $obj = clone $this;
        $obj->duration = $duration;

        return $obj;
    }

    /**
     * Original filename if available.
     */
    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj->fileName = $fileName;

        return $obj;
    }

    /**
     * File size in bytes if known.
     */
    public function withFileSize(float $fileSize): self
    {
        $obj = clone $this;
        $obj->fileSize = $fileSize;

        return $obj;
    }

    /**
     * True if the attachment is a GIF.
     */
    public function withIsGif(bool $isGif): self
    {
        $obj = clone $this;
        $obj->isGif = $isGif;

        return $obj;
    }

    /**
     * True if the attachment is a sticker.
     */
    public function withIsSticker(bool $isSticker): self
    {
        $obj = clone $this;
        $obj->isSticker = $isSticker;

        return $obj;
    }

    /**
     * True if the attachment is a voice note.
     */
    public function withIsVoiceNote(bool $isVoiceNote): self
    {
        $obj = clone $this;
        $obj->isVoiceNote = $isVoiceNote;

        return $obj;
    }

    /**
     * MIME type if known (e.g., 'image/png').
     */
    public function withMimeType(string $mimeType): self
    {
        $obj = clone $this;
        $obj->mimeType = $mimeType;

        return $obj;
    }

    /**
     * Preview image URL for video attachments (poster frame). May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    public function withPosterImg(string $posterImg): self
    {
        $obj = clone $this;
        $obj->posterImg = $posterImg;

        return $obj;
    }

    /**
     * Pixel dimensions of the attachment: width/height in px.
     */
    public function withSize(Size $size): self
    {
        $obj = clone $this;
        $obj->size = $size;

        return $obj;
    }

    /**
     * Public URL or local file path to fetch the asset. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    public function withSrcURL(string $srcURL): self
    {
        $obj = clone $this;
        $obj->srcURL = $srcURL;

        return $obj;
    }
}
