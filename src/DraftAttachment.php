<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\DraftAttachment\Size;
use BeeperDesktop\DraftAttachment\Type;

/**
 * @phpstan-import-type SizeShape from \BeeperDesktop\DraftAttachment\Size
 *
 * @phpstan-type DraftAttachmentShape = array{
 *   id: string,
 *   type: Type|value-of<Type>,
 *   audioDurationSeconds?: float|null,
 *   fileName?: string|null,
 *   filePath?: string|null,
 *   fileSize?: float|null,
 *   mimeType?: string|null,
 *   size?: null|Size|SizeShape,
 *   stickerID?: string|null,
 * }
 */
final class DraftAttachment implements BaseModel
{
    /** @use SdkModel<DraftAttachmentShape> */
    use SdkModel;

    /**
     * Draft attachment identifier.
     */
    #[Required]
    public string $id;

    /**
     * Draft attachment type. GIF and recorded audio are mutually exclusive types.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Audio duration in seconds if known.
     */
    #[Optional]
    public ?float $audioDurationSeconds;

    /**
     * Original filename if available.
     */
    #[Optional]
    public ?string $fileName;

    /**
     * Local filesystem path for the draft attachment.
     */
    #[Optional]
    public ?string $filePath;

    /**
     * File size in bytes if known.
     */
    #[Optional]
    public ?float $fileSize;

    /**
     * MIME type if known.
     */
    #[Optional]
    public ?string $mimeType;

    /**
     * Pixel dimensions of the attachment.
     */
    #[Optional]
    public ?Size $size;

    /**
     * Sticker identifier if the draft attachment is a sticker.
     */
    #[Optional]
    public ?string $stickerID;

    /**
     * `new DraftAttachment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DraftAttachment::with(id: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DraftAttachment)->withID(...)->withType(...)
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
        string $id,
        Type|string $type,
        ?float $audioDurationSeconds = null,
        ?string $fileName = null,
        ?string $filePath = null,
        ?float $fileSize = null,
        ?string $mimeType = null,
        Size|array|null $size = null,
        ?string $stickerID = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['type'] = $type;

        null !== $audioDurationSeconds && $self['audioDurationSeconds'] = $audioDurationSeconds;
        null !== $fileName && $self['fileName'] = $fileName;
        null !== $filePath && $self['filePath'] = $filePath;
        null !== $fileSize && $self['fileSize'] = $fileSize;
        null !== $mimeType && $self['mimeType'] = $mimeType;
        null !== $size && $self['size'] = $size;
        null !== $stickerID && $self['stickerID'] = $stickerID;

        return $self;
    }

    /**
     * Draft attachment identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Draft attachment type. GIF and recorded audio are mutually exclusive types.
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
     * Audio duration in seconds if known.
     */
    public function withAudioDurationSeconds(float $audioDurationSeconds): self
    {
        $self = clone $this;
        $self['audioDurationSeconds'] = $audioDurationSeconds;

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
     * Local filesystem path for the draft attachment.
     */
    public function withFilePath(string $filePath): self
    {
        $self = clone $this;
        $self['filePath'] = $filePath;

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
     * MIME type if known.
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * Pixel dimensions of the attachment.
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
     * Sticker identifier if the draft attachment is a sticker.
     */
    public function withStickerID(string $stickerID): self
    {
        $self = clone $this;
        $self['stickerID'] = $stickerID;

        return $self;
    }
}
