<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Unlock encrypted messages with the user recovery key.
 *
 * @see BeeperDesktop\Services\App\Login\Verification\RecoveryKeyService::verify()
 *
 * @phpstan-type RecoveryKeyVerifyParamsShape = array{recoveryKey: string}
 */
final class RecoveryKeyVerifyParams implements BaseModel
{
    /** @use SdkModel<RecoveryKeyVerifyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Recovery key saved by the user.
     */
    #[Required]
    public string $recoveryKey;

    /**
     * `new RecoveryKeyVerifyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecoveryKeyVerifyParams::with(recoveryKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RecoveryKeyVerifyParams)->withRecoveryKey(...)
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
    public static function with(string $recoveryKey): self
    {
        $self = new self;

        $self['recoveryKey'] = $recoveryKey;

        return $self;
    }

    /**
     * Recovery key saved by the user.
     */
    public function withRecoveryKey(string $recoveryKey): self
    {
        $self = clone $this;
        $self['recoveryKey'] = $recoveryKey;

        return $self;
    }
}
