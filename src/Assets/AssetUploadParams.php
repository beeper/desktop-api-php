<?php

declare(strict_types=1);

namespace BeeperDesktop\Assets;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Core\FileParam;

/**
 * Upload a file to a temporary location using multipart/form-data. Returns an uploadID that can be referenced when sending a message or creating a draft attachment.
 *
 * @see BeeperDesktop\Services\AssetsService::upload()
 *
 * @phpstan-type AssetUploadParamsShape = array{
 *   file: string|FileParam, fileName?: string|null, mimeType?: string|null
 * }
 */
final class AssetUploadParams implements BaseModel
{
    /** @use SdkModel<AssetUploadParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The file to upload (max 500 MB).
     */
    #[Required]
    public string $file;

    /**
     * Original filename. Defaults to the uploaded file name if omitted.
     */
    #[Optional]
    public ?string $fileName;

    /**
     * MIME type. Auto-detected from magic bytes if omitted.
     */
    #[Optional]
    public ?string $mimeType;

    /**
     * `new AssetUploadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetUploadParams::with(file: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetUploadParams)->withFile(...)
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
    public static function with(
        string|FileParam $file,
        ?string $fileName = null,
        ?string $mimeType = null
    ): self {
        $self = new self;

        $self['file'] = $file;

        null !== $fileName && $self['fileName'] = $fileName;
        null !== $mimeType && $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * The file to upload (max 500 MB).
     */
    public function withFile(string|FileParam $file): self
    {
        $self = clone $this;
        $self['file'] = $file;

        return $self;
    }

    /**
     * Original filename. Defaults to the uploaded file name if omitted.
     */
    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    /**
     * MIME type. Auto-detected from magic bytes if omitted.
     */
    public function withMimeType(string $mimeType): self
    {
        $self = clone $this;
        $self['mimeType'] = $mimeType;

        return $self;
    }
}
