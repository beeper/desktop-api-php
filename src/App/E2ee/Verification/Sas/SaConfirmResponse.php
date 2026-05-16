<?php

declare(strict_types=1);

namespace BeeperDesktop\App\E2ee\Verification\Sas;

use BeeperDesktop\App\E2ee\Verification\Sas\SaConfirmResponse\AppState;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AppStateShape from \BeeperDesktop\App\E2ee\Verification\Sas\SaConfirmResponse\AppState
 *
 * @phpstan-type SaConfirmResponseShape = array{appState: AppState|AppStateShape}
 */
final class SaConfirmResponse implements BaseModel
{
    /** @use SdkModel<SaConfirmResponseShape> */
    use SdkModel;

    /**
     * Current onboarding state after the requested step.
     */
    #[Required]
    public AppState $appState;

    /**
     * `new SaConfirmResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SaConfirmResponse::with(appState: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SaConfirmResponse)->withAppState(...)
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
