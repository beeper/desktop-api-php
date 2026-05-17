<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey;

use BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyResponse\Session;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SessionShape from \BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyResponse\Session
 *
 * @phpstan-type RecoveryKeyVerifyResponseShape = array{
 *   session: Session|SessionShape
 * }
 */
final class RecoveryKeyVerifyResponse implements BaseModel
{
    /** @use SdkModel<RecoveryKeyVerifyResponseShape> */
    use SdkModel;

    /**
     * Current app sign-in and encrypted messaging setup state.
     */
    #[Required]
    public Session $session;

    /**
     * `new RecoveryKeyVerifyResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RecoveryKeyVerifyResponse::with(session: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RecoveryKeyVerifyResponse)->withSession(...)
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
     * @param Session|SessionShape $session
     */
    public static function with(Session|array $session): self
    {
        $self = new self;

        $self['session'] = $session;

        return $self;
    }

    /**
     * Current app sign-in and encrypted messaging setup state.
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
