<?php

declare(strict_types=1);

namespace BeeperDesktop\App;

use BeeperDesktop\App\LoginRegistrationRequiredResponse\Copy;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type CopyShape from \BeeperDesktop\App\LoginRegistrationRequiredResponse\Copy
 *
 * @phpstan-type LoginRegistrationRequiredResponseShape = array{
 *   copy: Copy|CopyShape,
 *   leadToken: string,
 *   registrationRequired: bool,
 *   request: string,
 *   usernameSuggestions?: list<string>|null,
 * }
 */
final class LoginRegistrationRequiredResponse implements BaseModel
{
    /** @use SdkModel<LoginRegistrationRequiredResponseShape> */
    use SdkModel;

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
     * Indicates that the user needs to create a Beeper account.
     */
    #[Required]
    public bool $registrationRequired;

    /**
     * Login request ID to use when creating the account.
     */
    #[Required]
    public string $request;

    /**
     * Suggested usernames for the new account.
     *
     * @var list<string>|null $usernameSuggestions
     */
    #[Optional(list: 'string')]
    public ?array $usernameSuggestions;

    /**
     * `new LoginRegistrationRequiredResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LoginRegistrationRequiredResponse::with(
     *   copy: ..., leadToken: ..., registrationRequired: ..., request: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LoginRegistrationRequiredResponse)
     *   ->withCopy(...)
     *   ->withLeadToken(...)
     *   ->withRegistrationRequired(...)
     *   ->withRequest(...)
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
        bool $registrationRequired,
        string $request,
        ?array $usernameSuggestions = null,
    ): self {
        $self = new self;

        $self['copy'] = $copy;
        $self['leadToken'] = $leadToken;
        $self['registrationRequired'] = $registrationRequired;
        $self['request'] = $request;

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
     * Login request ID to use when creating the account.
     */
    public function withRequest(string $request): self
    {
        $self = clone $this;
        $self['request'] = $request;

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
