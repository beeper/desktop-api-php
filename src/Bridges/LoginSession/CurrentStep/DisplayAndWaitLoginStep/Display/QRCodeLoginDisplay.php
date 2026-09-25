<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep\DisplayAndWaitLoginStep\Display;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type QRCodeLoginDisplayShape = array{data: string, type: 'qr'}
 */
final class QRCodeLoginDisplay implements BaseModel
{
    /** @use SdkModel<QRCodeLoginDisplayShape> */
    use SdkModel;

    /** @var 'qr' $type */
    #[Required]
    public string $type = 'qr';

    #[Required]
    public string $data;

    /**
     * `new QRCodeLoginDisplay()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QRCodeLoginDisplay::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QRCodeLoginDisplay)->withData(...)
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

    public function withData(string $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param 'qr' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
