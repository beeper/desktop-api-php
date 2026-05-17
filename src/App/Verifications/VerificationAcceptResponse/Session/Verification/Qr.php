<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\VerificationAcceptResponse\Session\Verification;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * QR verification data.
 *
 * @phpstan-type QrShape = array{data: string}
 */
final class Qr implements BaseModel
{
    /** @use SdkModel<QrShape> */
    use SdkModel;

    /**
     * QR code payload to display for verification.
     */
    #[Required]
    public string $data;

    /**
     * `new Qr()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Qr::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Qr)->withData(...)
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
    public static function with(string $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * QR code payload to display for verification.
     */
    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
