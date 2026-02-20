<?php

declare(strict_types=1);

namespace BeeperDesktop\Assets;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Download a Matrix asset using its mxc:// or localmxc:// URL to the device running Beeper Desktop and return the local file URL.
 *
 * @see BeeperDesktop\Services\AssetsService::download()
 *
 * @phpstan-type AssetDownloadParamsShape = array{url: string}
 */
final class AssetDownloadParams implements BaseModel
{
    /** @use SdkModel<AssetDownloadParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Matrix content URL (mxc:// or localmxc://) for the asset to download.
     */
    #[Required]
    public string $url;

    /**
     * `new AssetDownloadParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetDownloadParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetDownloadParams)->withURL(...)
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
    public static function with(string $url): self
    {
        $self = new self;

        $self['url'] = $url;

        return $self;
    }

    /**
     * Matrix content URL (mxc:// or localmxc://) for the asset to download.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
