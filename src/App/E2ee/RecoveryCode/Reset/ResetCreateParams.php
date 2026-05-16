<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\RecoveryCode\Reset;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Create a new recovery key when the user cannot use the existing one.
 *
 * @see BeeperDesktop\Services\App\E2ee\RecoveryCode\ResetService::create()
 *
 * @phpstan-type ResetCreateParamsShape = array{recoveryCode?: string|null}
 */
final class ResetCreateParams implements BaseModel
{
    /** @use SdkModel<ResetCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Existing recovery key, if the user has it.
     */
    #[Optional]
    public ?string $recoveryCode;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $recoveryCode = null): self
    {
        $self = new self;

        null !== $recoveryCode && $self['recoveryCode'] = $recoveryCode;

        return $self;
    }

    /**
     * Existing recovery key, if the user has it.
     */
    public function withRecoveryCode(string $recoveryCode): self
    {
        $self = clone $this;
        $self['recoveryCode'] = $recoveryCode;

        return $self;
    }
}
