<?php

declare(strict_types=1);

namespace BeeperDesktop\Assets;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Upload a file using a JSON body with base64-encoded content. Returns an uploadID that can be referenced when sending a message or creating a draft attachment. Alternative to the multipart upload endpoint.
 *
 * @see BeeperDesktop\Services\AssetsService::uploadBase64()
 *
 * @phpstan-type AssetUploadBase64ParamsShape = array{
 *   content: string, fileName?: string|null, mimeType?: string|null
 * }
 */
final class AssetUploadBase64Params implements BaseModel
{
    /** @use SdkModel<AssetUploadBase64ParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Base64-encoded file content (max ~500MB decoded).
     */
    #[Required]
    public string $content;

    /**
     * Original filename. Generated if omitted.
     */
    #[Optional]
    public ?string $fileName;

    /**
     * MIME type. Auto-detected from magic bytes if omitted.
     */
    #[Optional]
    public ?string $mimeType;

    /**
     * `new AssetUploadBase64Params()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetUploadBase64Params::with(content: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetUploadBase64Params)->withContent(...)
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
        string $content,
        ?string $fileName = null,
        ?string $mimeType = null
    ): self {
        $self = new self;

        $self['content'] = $content;

        null !== $fileName && $self['fileName'] = $fileName;
        null !== $mimeType && $self['mimeType'] = $mimeType;

        return $self;
    }

    /**
     * Base64-encoded file content (max ~500MB decoded).
     */
    public function withContent(string $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Original filename. Generated if omitted.
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
