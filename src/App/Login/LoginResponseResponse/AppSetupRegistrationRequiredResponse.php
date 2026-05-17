<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\LoginResponseResponse;

use BeeperDesktop\App\Login\LoginResponseResponse\AppSetupRegistrationRequiredResponse\Copy;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CopyShape from \BeeperDesktop\App\Login\LoginResponseResponse\AppSetupRegistrationRequiredResponse\Copy
 *
 * @phpstan-type AppSetupRegistrationRequiredResponseShape = array{
 *   copy: Copy|CopyShape,
 *   leadToken: string,
 *   registrationRequired: bool,
 *   setupRequestID: string,
 *   usernameSuggestions?: list<string>|null,
 * }
 */
final class AppSetupRegistrationRequiredResponse implements BaseModel
{
    /** @use SdkModel<AppSetupRegistrationRequiredResponseShape> */
    use SdkModel;

    /**
     * Indicates that the user needs to create a Beeper account.
     */
    #[Required]
    public bool $registrationRequired = true;

    /**
     * Copy to display during account creation.
     */
    #[Required]
    public Copy $copy;

    /**
     * Registration token returned by Beeper.
     */
    #[Required]
    public string $leadToken;

    /**
     * Setup request ID to use when creating the account.
     */
    #[Required]
    public string $setupRequestID;

    /**
     * Suggested usernames for the new account.
     *
     * @var list<string>|null $usernameSuggestions
     */
    #[Optional(list: 'string')]
    public ?array $usernameSuggestions;

    /**
     * `new AppSetupRegistrationRequiredResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AppSetupRegistrationRequiredResponse::with(
     *   copy: ..., leadToken: ..., setupRequestID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AppSetupRegistrationRequiredResponse)
     *   ->withCopy(...)
     *   ->withLeadToken(...)
     *   ->withSetupRequestID(...)
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
     * @param Copy|CopyShape $copy
     * @param list<string>|null $usernameSuggestions
     */
    public static function with(
        Copy|array $copy,
        string $leadToken,
        string $setupRequestID,
        ?array $usernameSuggestions = null,
    ): self {
        $self = new self;

        $self['copy'] = $copy;
        $self['leadToken'] = $leadToken;
        $self['setupRequestID'] = $setupRequestID;

        null !== $usernameSuggestions && $self['usernameSuggestions'] = $usernameSuggestions;

        return $self;
    }

    /**
     * Copy to display during account creation.
     *
     * @param Copy|CopyShape $copy
     */
    public function withCopy(Copy|array $copy): self
    {
        $self = clone $this;
        $self['copy'] = $copy;

        return $self;
    }

    /**
     * Registration token returned by Beeper.
     */
    public function withLeadToken(string $leadToken): self
    {
        $self = clone $this;
        $self['leadToken'] = $leadToken;

        return $self;
    }

    /**
     * Indicates that the user needs to create a Beeper account.
     */
    public function withRegistrationRequired(bool $registrationRequired): self
    {
        $self = clone $this;
        $self['registrationRequired'] = $registrationRequired;

        return $self;
    }

    /**
     * Setup request ID to use when creating the account.
     */
    public function withSetupRequestID(string $setupRequestID): self
    {
        $self = clone $this;
        $self['setupRequestID'] = $setupRequestID;

        return $self;
    }

    /**
     * Suggested usernames for the new account.
     *
     * @param list<string> $usernameSuggestions
     */
    public function withUsernameSuggestions(array $usernameSuggestions): self
    {
        $self = clone $this;
        $self['usernameSuggestions'] = $usernameSuggestions;

        return $self;
    }
}
