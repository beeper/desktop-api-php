<?php

declare(strict_types=1);

namespace BeeperDesktop\Info\InfoGetResponse;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type PlatformShape = array{
 *   arch: string, os: string, release?: string|null
 * }
 */
final class Platform implements BaseModel
{
    /** @use SdkModel<PlatformShape> */
    use SdkModel;

    /**
     * CPU architecture.
     */
    #[Required]
    public string $arch;

    /**
     * Operating system identifier.
     */
    #[Required]
    public string $os;

    /**
     * Runtime release version.
     */
    #[Optional]
    public ?string $release;

    /**
     * `new Platform()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Platform::with(arch: ..., os: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Platform)->withArch(...)->withOs(...)
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
        string $arch,
        string $os,
        ?string $release = null
    ): self {
        $self = new self;

        $self['arch'] = $arch;
        $self['os'] = $os;

        null !== $release && $self['release'] = $release;

        return $self;
    }

    /**
     * CPU architecture.
     */
    public function withArch(string $arch): self
    {
        $self = clone $this;
        $self['arch'] = $arch;

        return $self;
    }

    /**
     * Operating system identifier.
     */
    public function withOs(string $os): self
    {
        $self = clone $this;
        $self['os'] = $os;

        return $self;
    }

    /**
     * Runtime release version.
     */
    public function withRelease(string $release): self
    {
        $self = clone $this;
        $self['release'] = $release;

        return $self;
    }
}
