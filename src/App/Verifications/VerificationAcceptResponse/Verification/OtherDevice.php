<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\VerificationAcceptResponse\Verification;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Other device participating in verification.
 *
 * @phpstan-type OtherDeviceShape = array{id: string, name?: string|null}
 */
final class OtherDevice implements BaseModel
{
    /** @use SdkModel<OtherDeviceShape> */
    use SdkModel;

    /**
     * Other device ID.
     */
    #[Required]
    public string $id;

    /**
     * Other device display name, if known.
     */
    #[Optional]
    public ?string $name;

    /**
     * `new OtherDevice()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * OtherDevice::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new OtherDevice)->withID(...)
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
    public static function with(string $id, ?string $name = null): self
    {
        $self = new self;

        $self['id'] = $id;

        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * Other device ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Other device display name, if known.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
