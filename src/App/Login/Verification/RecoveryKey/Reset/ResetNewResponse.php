<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\Verification\RecoveryKey\Reset;

use BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetNewResponse\Session;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SessionShape from \BeeperDesktop\App\Login\Verification\RecoveryKey\Reset\ResetNewResponse\Session
 *
 * @phpstan-type ResetNewResponseShape = array{
 *   recoveryKey: string, session: Session|SessionShape
 * }
 */
final class ResetNewResponse implements BaseModel
{
    /** @use SdkModel<ResetNewResponseShape> */
    use SdkModel;

    /**
     * New recovery key. Show it once and ask the user to save it.
     */
    #[Required]
    public string $recoveryKey;

    /**
     * Current app sign-in and encrypted messaging setup state after creating the new recovery key.
     */
    #[Required]
    public Session $session;

    /**
     * `new ResetNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ResetNewResponse::with(recoveryKey: ..., session: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ResetNewResponse)->withRecoveryKey(...)->withSession(...)
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
    public static function with(
        string $recoveryKey,
        Session|array $session
    ): self {
        $self = new self;

        $self['recoveryKey'] = $recoveryKey;
        $self['session'] = $session;

        return $self;
    }

    /**
     * New recovery key. Show it once and ask the user to save it.
     */
    public function withRecoveryKey(string $recoveryKey): self
    {
        $self = clone $this;
        $self['recoveryKey'] = $recoveryKey;

        return $self;
    }

    /**
     * Current app sign-in and encrypted messaging setup state after creating the new recovery key.
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
