<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login;

use BeeperDesktop\App\Login\LoginRegisterResponse\Matrix;
use BeeperDesktop\App\Login\LoginRegisterResponse\Session;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type MatrixShape from \BeeperDesktop\App\Login\LoginRegisterResponse\Matrix
 * @phpstan-import-type SessionShape from \BeeperDesktop\App\Login\LoginRegisterResponse\Session
 *
 * @phpstan-type LoginRegisterResponseShape = array{
 *   matrix: Matrix|MatrixShape, session: Session|SessionShape
 * }
 */
final class LoginRegisterResponse implements BaseModel
{
    /** @use SdkModel<LoginRegisterResponseShape> */
    use SdkModel;

    /**
     * Account credentials for first-party app setup.
     */
    #[Required]
    public Matrix $matrix;

    /**
     * Current app sign-in and encrypted messaging setup state after sign-in.
     */
    #[Required]
    public Session $session;

    /**
     * `new LoginRegisterResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginRegisterResponse::with(matrix: ..., session: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginRegisterResponse)->withMatrix(...)->withSession(...)
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
     * @param Matrix|MatrixShape $matrix
     * @param Session|SessionShape $session
     */
    public static function with(
        Matrix|array $matrix,
        Session|array $session
    ): self {
        $self = new self;

        $self['matrix'] = $matrix;
        $self['session'] = $session;

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

    /**
     * Current app sign-in and encrypted messaging setup state after sign-in.
     *
     * @param Session|SessionShape $session
     */
    public function withSession(Session|array $session): self
    {
        $self = clone $this;
        $self['session'] = $session;

        return $self;
    }
}
