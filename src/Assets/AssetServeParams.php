<?php

declare(strict_types=1);

namespace BeeperDesktop\Assets;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Stream a file given an mxc://, localmxc://, or file:// URL. Downloads first if not cached. Supports Range requests for seeking in large files.
 *
 * @see BeeperDesktop\Services\AssetsService::serve()
 *
 * @phpstan-type AssetServeParamsShape = array{url: string}
 */
final class AssetServeParams implements BaseModel
{
    /** @use SdkModel<AssetServeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * File URL to serve. Accepts mxc://, localmxc://, or file:// URLs.
     */
    #[Required]
    public string $url;

    /**
     * `new AssetServeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AssetServeParams::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AssetServeParams)->withURL(...)
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
     * File URL to serve. Accepts mxc://, localmxc://, or file:// URLs.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
