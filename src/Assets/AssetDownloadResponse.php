<?php

declare(strict_types=1);

namespace BeeperDesktop\Assets;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type AssetDownloadResponseShape = array{
 *   error?: string|null, srcURL?: string|null
 * }
 */
final class AssetDownloadResponse implements BaseModel
{
    /** @use SdkModel<AssetDownloadResponseShape> */
    use SdkModel;

    /**
     * Error message if the download failed.
     */
    #[Optional]
    public ?string $error;

    /**
     * Local file URL to the downloaded file.
     */
    #[Optional]
    public ?string $srcURL;

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
        ?string $error = null,
        ?string $srcURL = null
    ): self {
        $self = new self;

        null !== $error && $self['error'] = $error;
        null !== $srcURL && $self['srcURL'] = $srcURL;

        return $self;
    }

    /**
     * Error message if the download failed.
     */
    public function withError(string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }

    /**
     * Local file URL to the downloaded file.
     */
    public function withSrcURL(string $srcURL): self
    {
        $self = clone $this;
        $self['srcURL'] = $srcURL;

        return $self;
    }
}
