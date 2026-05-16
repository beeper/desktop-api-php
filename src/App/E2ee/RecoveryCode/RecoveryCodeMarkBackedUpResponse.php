<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\RecoveryCode;

use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeMarkBackedUpResponse\AppState;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AppStateShape from \BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeMarkBackedUpResponse\AppState
 *
 * @phpstan-type RecoveryCodeMarkBackedUpResponseShape = array{
 *   appState: AppState|AppStateShape
 * }
 */
final class RecoveryCodeMarkBackedUpResponse implements BaseModel
{
    /** @use SdkModel<RecoveryCodeMarkBackedUpResponseShape> */
    use SdkModel;

    /**
     * Current onboarding state after the requested step.
     */
    #[Required]
    public AppState $appState;

    /**
     * `new RecoveryCodeMarkBackedUpResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecoveryCodeMarkBackedUpResponse::with(appState: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RecoveryCodeMarkBackedUpResponse)->withAppState(...)
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
    public static function with(AppState|array $appState): self
    {
        $self = new self;

        $self['appState'] = $appState;

        return $self;
    }

    /**
     * Current onboarding state after the requested step.
     *
     * @param AppState|AppStateShape $appState
     */
    public function withAppState(AppState|array $appState): self
    {
        $self = clone $this;
        $self['appState'] = $appState;

        return $self;
    }
}
