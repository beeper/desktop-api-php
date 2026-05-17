<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Verifications\Qr;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Submit the QR code scanned from another signed-in device.
 *
 * @see BeeperDesktop\Services\App\Verifications\QrService::scan()
 *
 * @phpstan-type QrScanParamsShape = array{data: string}
 */
final class QrScanParams implements BaseModel
{
    /** @use SdkModel<QrScanParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * QR code payload scanned from the other device.
     */
    #[Required]
    public string $data;

    /**
     * `new QrScanParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QrScanParams::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QrScanParams)->withData(...)
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
     * QR code payload scanned from the other device.
     */
    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
