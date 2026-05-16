<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\App\Login\LoginRegisterResponse\AppState;
use BeeperDesktop\App\Login\LoginRegisterResponse\DesktopAPI;
use BeeperDesktop\App\Login\LoginRegisterResponse\Matrix;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AppStateShape from \BeeperDesktop\App\Login\LoginRegisterResponse\AppState
 * @phpstan-import-type DesktopAPIShape from \BeeperDesktop\App\Login\LoginRegisterResponse\DesktopAPI
 * @phpstan-import-type MatrixShape from \BeeperDesktop\App\Login\LoginRegisterResponse\Matrix
 *
 * @phpstan-type LoginRegisterResponseShape = array{
 *   appState: AppState|AppStateShape,
 *   desktopAPI: DesktopAPI|DesktopAPIShape,
 *   matrix: Matrix|MatrixShape,
 * }
 */
final class LoginRegisterResponse implements BaseModel
{
    /** @use SdkModel<LoginRegisterResponseShape> */
    use SdkModel;

    /**
     * Current onboarding state after sign-in.
     */
    #[Required]
    public AppState $appState;

    /**
     * Desktop API credentials for the signed-in app session.
     */
    #[Required]
    public DesktopAPI $desktopAPI;

    /**
     * Account credentials for first-party app setup.
     */
    #[Required]
    public Matrix $matrix;

    /**
     * `new LoginRegisterResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginRegisterResponse::with(appState: ..., desktopAPI: ..., matrix: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginRegisterResponse)
     *   ->withAppState(...)
     *   ->withDesktopAPI(...)
     *   ->withMatrix(...)
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
     * @param DesktopAPI|DesktopAPIShape $desktopAPI
     * @param Matrix|MatrixShape $matrix
     */
    public static function with(
        AppState|array $appState,
        DesktopAPI|array $desktopAPI,
        Matrix|array $matrix
    ): self {
        $self = new self;

        $self['appState'] = $appState;
        $self['desktopAPI'] = $desktopAPI;
        $self['matrix'] = $matrix;

        return $self;
    }

    /**
     * Current onboarding state after sign-in.
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
     * Desktop API credentials for the signed-in app session.
     *
     * @param DesktopAPI|DesktopAPIShape $desktopAPI
     */
    public function withDesktopAPI(DesktopAPI|array $desktopAPI): self
    {
        $self = clone $this;
        $self['desktopAPI'] = $desktopAPI;

        return $self;
    }

    /**
     * Account credentials for first-party app setup.
     *
     * @param Matrix|MatrixShape $matrix
     */
    public function withMatrix(Matrix|array $matrix): self
    {
        $self = clone $this;
        $self['matrix'] = $matrix;

        return $self;
    }
}
