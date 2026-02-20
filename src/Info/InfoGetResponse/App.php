<?php

declare(strict_types=1);

namespace BeeperDesktop\Info\InfoGetResponse;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type AppShape = array{bundleID: string, name: string, version: string}
 */
final class App implements BaseModel
{
    /** @use SdkModel<AppShape> */
    use SdkModel;

    /**
     * App bundle identifier.
     */
    #[Required('bundle_id')]
    public string $bundleID;

    /**
     * App name.
     */
    #[Required]
    public string $name;

    /**
     * App version.
     */
    #[Required]
    public string $version;

    /**
     * `new App()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * App::with(bundleID: ..., name: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new App)->withBundleID(...)->withName(...)->withVersion(...)
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
        string $bundleID,
        string $name,
        string $version
    ): self {
        $self = new self;

        $self['bundleID'] = $bundleID;
        $self['name'] = $name;
        $self['version'] = $version;

        return $self;
    }

    /**
     * App bundle identifier.
     */
    public function withBundleID(string $bundleID): self
    {
        $self = clone $this;
        $self['bundleID'] = $bundleID;

        return $self;
    }

    /**
     * App name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * App version.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
