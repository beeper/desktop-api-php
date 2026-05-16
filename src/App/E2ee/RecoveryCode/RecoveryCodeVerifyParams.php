<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\RecoveryCode;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Unlock encrypted messages with the user recovery key.
 *
 * @see BeeperDesktop\Services\App\E2ee\RecoveryCodeService::verify()
 *
 * @phpstan-type RecoveryCodeVerifyParamsShape = array{recoveryCode: string}
 */
final class RecoveryCodeVerifyParams implements BaseModel
{
    /** @use SdkModel<RecoveryCodeVerifyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Recovery key saved by the user.
     */
    #[Required]
    public string $recoveryCode;

    /**
     * `new RecoveryCodeVerifyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecoveryCodeVerifyParams::with(recoveryCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RecoveryCodeVerifyParams)->withRecoveryCode(...)
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
    public static function with(string $recoveryCode): self
    {
        $self = new self;

        $self['recoveryCode'] = $recoveryCode;

        return $self;
    }

    /**
     * Recovery key saved by the user.
     */
    public function withRecoveryCode(string $recoveryCode): self
    {
        $self = clone $this;
        $self['recoveryCode'] = $recoveryCode;

        return $self;
    }
}
