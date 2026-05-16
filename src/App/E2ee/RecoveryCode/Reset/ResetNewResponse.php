<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\RecoveryCode\Reset;

use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetNewResponse\AppState;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AppStateShape from \BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetNewResponse\AppState
 *
 * @phpstan-type ResetNewResponseShape = array{
 *   appState: AppState|AppStateShape, recoveryCode: string
 * }
 */
final class ResetNewResponse implements BaseModel
{
    /** @use SdkModel<ResetNewResponseShape> */
    use SdkModel;

    /**
     * Current onboarding state after creating the new recovery key.
     */
    #[Required]
    public AppState $appState;

    /**
     * New recovery key. Show it once and ask the user to save it.
     */
    #[Required]
    public string $recoveryCode;

    /**
     * `new ResetNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ResetNewResponse::with(appState: ..., recoveryCode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ResetNewResponse)->withAppState(...)->withRecoveryCode(...)
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
     *
     * @param AppState|AppStateShape $appState
     */
    public static function with(
        AppState|array $appState,
        string $recoveryCode
    ): self {
        $self = new self;

        $self['appState'] = $appState;
        $self['recoveryCode'] = $recoveryCode;

        return $self;
    }

    /**
     * Current onboarding state after creating the new recovery key.
     *
     * @param AppState|AppStateShape $appState
     */
    public function withAppState(AppState|array $appState): self
    {
        $self = clone $this;
        $self['appState'] = $appState;

        return $self;
    }

    /**
     * New recovery key. Show it once and ask the user to save it.
     */
    public function withRecoveryCode(string $recoveryCode): self
    {
        $self = clone $this;
        $self['recoveryCode'] = $recoveryCode;

        return $self;
    }
}
