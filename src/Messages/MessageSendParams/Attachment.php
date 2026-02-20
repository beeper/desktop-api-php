<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages\MessageSendParams;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Messages\MessageSendParams\Attachment\Size;
use BeeperDesktop\Messages\MessageSendParams\Attachment\Type;

/**
 * Single attachment to send with the message.
 *
 * @phpstan-import-type SizeShape from \BeeperDesktop\Messages\MessageSendParams\Attachment\Size
 *
 * @phpstan-type AttachmentShape = array{
 *   uploadID: string,
 *   duration?: float|null,
 *   fileName?: string|null,
 *   mimeType?: string|null,
 *   size?: null|Size|SizeShape,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class Attachment implements BaseModel
{
    /** @use SdkModel<AttachmentShape> */
    use SdkModel;

    /**
     * Upload ID from uploadAsset endpoint. Required to reference uploaded files.
     */
    #[Required]
    public string $uploadID;

    /**
     * Duration in seconds (optional override of cached value).
     */
    #[Optional]
    public ?float $duration;

    /**
     * Filename (optional override of cached value).
     */
    #[Optional]
    public ?string $fileName;

    /**
     * MIME type (optional override of cached value).
     */
    #[Optional]
    public ?string $mimeType;

    /**
     * Dimensions (optional override of cached value).
     */
    #[Optional]
    public ?Size $size;

    /**
     * Special attachment type (gif, voiceNote, sticker). If omitted, auto-detected from mimeType.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new Attachment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Attachment::with(uploadID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Attachment)->withUploadID(...)
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
     * @param Size|SizeShape|null $size
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $uploadID,
        ?float $duration = null,
        ?string $fileName = null,
        ?string $mimeType = null,
        Size|array|null $size = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['uploadID'] = $uploadID;

        null !== $duration && $self['duration'] = $duration;
        null !== $fileName && $self['fileName'] = $fileName;
        null !== $mimeType && $self['mimeType'] = $mimeType;
        null !== $size && $self['size'] = $size;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Upload ID from uploadAsset endpoint. Required to reference uploaded files.
     */
    public function withUploadID(string $uploadID): self
    {
        $self = clone $this;
        $self['uploadID'] = $uploadID;

        return $self;
    }

    /**
     * Duration in seconds (optional override of cached value).
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Filename (optional override of cached value).
     */
    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    /**
     * MIME type (optional override of cached value).
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * Dimensions (optional override of cached value).
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
     * Special attachment type (gif, voiceNote, sticker). If omitted, auto-detected from mimeType.
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
