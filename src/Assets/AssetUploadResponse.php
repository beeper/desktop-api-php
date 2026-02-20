<?php

declare(strict_types=1);

namespace BeeperDesktop\Assets;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetUploadResponseShape = array{
 *   duration?: float|null,
 *   error?: string|null,
 *   fileName?: string|null,
 *   fileSize?: float|null,
 *   height?: float|null,
 *   mimeType?: string|null,
 *   srcURL?: string|null,
 *   uploadID?: string|null,
 *   width?: float|null,
 * }
 */
final class AssetUploadResponse implements BaseModel
{
    /** @use SdkModel<AssetUploadResponseShape> */
    use SdkModel;

    /**
     * Duration in seconds (audio/videos).
     */
    #[Optional]
    public ?float $duration;

    /**
     * Error message if upload failed.
     */
    #[Optional]
    public ?string $error;

    /**
     * Resolved filename.
     */
    #[Optional]
    public ?string $fileName;

    /**
     * File size in bytes.
     */
    #[Optional]
    public ?float $fileSize;

    /**
     * Height in pixels (images/videos).
     */
    #[Optional]
    public ?float $height;

    /**
     * Detected or provided MIME type.
     */
    #[Optional]
    public ?string $mimeType;

    /**
     * Local file URL (file://) for the uploaded asset.
     */
    #[Optional]
    public ?string $srcURL;

    /**
     * Unique upload ID for this asset.
     */
    #[Optional]
    public ?string $uploadID;

    /**
     * Width in pixels (images/videos).
     */
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
    public static function with(
        ?float $duration = null,
        ?string $error = null,
        ?string $fileName = null,
        ?float $fileSize = null,
        ?float $height = null,
        ?string $mimeType = null,
        ?string $srcURL = null,
        ?string $uploadID = null,
        ?float $width = null,
    ): self {
        $self = new self;

        null !== $duration && $self['duration'] = $duration;
        null !== $error && $self['error'] = $error;
        null !== $fileName && $self['fileName'] = $fileName;
        null !== $fileSize && $self['fileSize'] = $fileSize;
        null !== $height && $self['height'] = $height;
        null !== $mimeType && $self['mimeType'] = $mimeType;
        null !== $srcURL && $self['srcURL'] = $srcURL;
        null !== $uploadID && $self['uploadID'] = $uploadID;
        null !== $width && $self['width'] = $width;

        return $self;
    }

    /**
     * Duration in seconds (audio/videos).
     */
    public function withDuration(float $duration): self
    {
        $self = clone $this;
        $self['duration'] = $duration;

        return $self;
    }

    /**
     * Error message if upload failed.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Resolved filename.
     */
    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    /**
     * File size in bytes.
     */
    public function withFileSize(float $fileSize): self
    {
        $self = clone $this;
        $self['fileSize'] = $fileSize;

        return $self;
    }

    /**
     * Height in pixels (images/videos).
     */
    public function withHeight(float $height): self
    {
        $self = clone $this;
        $self['height'] = $height;

        return $self;
    }

    /**
     * Detected or provided MIME type.
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * Local file URL (file://) for the uploaded asset.
     */
    public function withSrcURL(string $srcURL): self
    {
        $self = clone $this;
        $self['srcURL'] = $srcURL;

        return $self;
    }

    /**
     * Unique upload ID for this asset.
     */
    public function withUploadID(string $uploadID): self
    {
        $self = clone $this;
        $self['uploadID'] = $uploadID;

        return $self;
    }

    /**
     * Width in pixels (images/videos).
     */
    public function withWidth(float $width): self
    {
        $self = clone $this;
        $self['width'] = $width;

        return $self;
    }
}
