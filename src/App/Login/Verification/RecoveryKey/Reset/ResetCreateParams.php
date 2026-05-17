<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey\Reset;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Create a new recovery key when the user cannot use the existing one.
 *
 * @see BeeperDesktop\Services\App\Login\Verification\RecoveryKey\ResetService::create()
 *
 * @phpstan-type ResetCreateParamsShape = array{existingRecoveryKey?: string|null}
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
    public ?string $existingRecoveryKey;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $existingRecoveryKey = null): self
    {
        $self = new self;

        null !== $existingRecoveryKey && $self['existingRecoveryKey'] = $existingRecoveryKey;

        return $self;
    }

    /**
     * Existing recovery key, if the user has it.
     */
    public function withExistingRecoveryKey(string $existingRecoveryKey): self
    {
        $self = clone $this;
        $self['existingRecoveryKey'] = $existingRecoveryKey;

        return $self;
    }
}
