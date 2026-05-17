<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges\LoginSession\CurrentStep;

use BeeperDesktop\Accounts\Account;
use BeeperDesktop\Bridges\LoginSession\CurrentStep\CompleteLoginStep\Login;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AccountShape from \BeeperDesktop\Accounts\Account
 * @phpstan-import-type LoginShape from \BeeperDesktop\Bridges\LoginSession\CurrentStep\CompleteLoginStep\Login
 *
 * @phpstan-type CompleteLoginStepShape = array{
 *   type: 'complete',
 *   account?: null|Account|AccountShape,
 *   instructions?: string|null,
 *   login?: null|Login|LoginShape,
 *   stepID?: string|null,
 * }
 */
final class CompleteLoginStep implements BaseModel
{
    /** @use SdkModel<CompleteLoginStepShape> */
    use SdkModel;

    /** @var 'complete' $type */
    #[Required]
    public string $type = 'complete';

    /**
     * A chat account added to Beeper.
     */
    #[Optional]
    public ?Account $account;

    /**
     * Completion instructions, when provided.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * Signed-in identity for a bridge. One bridge login can contain multiple chat accounts.
     */
    #[Optional]
    public ?Login $login;

    #[Optional]
    public ?string $stepID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Account|AccountShape|null $account
     * @param Login|LoginShape|null $login
     */
    public static function with(
        Account|array|null $account = null,
        ?string $instructions = null,
        Login|array|null $login = null,
        ?string $stepID = null,
    ): self {
        $self = new self;

        null !== $account && $self['account'] = $account;
        null !== $instructions && $self['instructions'] = $instructions;
        null !== $login && $self['login'] = $login;
        null !== $stepID && $self['stepID'] = $stepID;

        return $self;
    }

    /**
     * @param 'complete' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * A chat account added to Beeper.
     *
     * @param Account|AccountShape $account
     */
    public function withAccount(Account|array $account): self
    {
        $self = clone $this;
        $self['account'] = $account;

        return $self;
    }

    /**
     * Completion instructions, when provided.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * Signed-in identity for a bridge. One bridge login can contain multiple chat accounts.
     *
     * @param Login|LoginShape $login
     */
    public function withLogin(Login|array $login): self
    {
        $self = clone $this;
        $self['login'] = $login;

        return $self;
    }

    public function withStepID(string $stepID): self
    {
        $self = clone $this;
        $self['stepID'] = $stepID;

        return $self;
    }
}
