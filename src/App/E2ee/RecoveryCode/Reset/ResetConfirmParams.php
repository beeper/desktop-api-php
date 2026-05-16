<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\RecoveryCode\Reset;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Confirm that the new recovery key should be used for this account.
 *
 * @see BeeperDesktop\Services\App\E2ee\RecoveryCode\ResetService::confirm()
 *
 * @phpstan-type ResetConfirmParamsShape = array{recoveryCode: string}
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
    public string $recoveryCode;

    /**
     * `new ResetConfirmParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ResetConfirmParams::with(recoveryCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ResetConfirmParams)->withRecoveryCode(...)
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
     * New recovery key returned by the reset step.
     */
    public function withRecoveryCode(string $recoveryCode): self
    {
        $self = clone $this;
        $self['recoveryCode'] = $recoveryCode;

        return $self;
    }
}
