<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey\Reset;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Confirm that the new recovery key should be used for this account.
 *
 * @see BeeperDesktop\Services\App\Login\Verification\RecoveryKey\ResetService::confirm()
 *
 * @phpstan-type ResetConfirmParamsShape = array{recoveryKey: string}
 */
final class ResetConfirmParams implements BaseModel
{
    /** @use SdkModel<ResetConfirmParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * New recovery key returned by the reset step.
     */
    #[Required]
    public string $recoveryKey;

    /**
     * `new ResetConfirmParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ResetConfirmParams::with(recoveryKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ResetConfirmParams)->withRecoveryKey(...)
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
     * New recovery key returned by the reset step.
     */
    public function withRecoveryKey(string $recoveryKey): self
    {
        $self = clone $this;
        $self['recoveryKey'] = $recoveryKey;

        return $self;
    }
}
