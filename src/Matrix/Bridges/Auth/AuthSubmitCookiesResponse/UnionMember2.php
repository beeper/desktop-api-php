<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember2\Cookies;

/**
 * Cookie login step.
 *
 * @phpstan-import-type CookiesShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthSubmitCookiesResponse\UnionMember2\Cookies
 *
 * @phpstan-type UnionMember2Shape = array{
 *   cookies: Cookies|CookiesShape,
 *   type: 'cookies',
 *   instructions?: string|null,
 *   loginID?: string|null,
 *   stepID?: string|null,
 * }
 */
final class UnionMember2 implements BaseModel
{
    /** @use SdkModel<UnionMember2Shape> */
    use SdkModel;

    /** @var 'cookies' $type */
    #[Required]
    public string $type = 'cookies';

    /**
     * Parameters for the cookie login step.
     */
    #[Required]
    public Cookies $cookies;

    /**
     * Human-readable instructions for completing this login step.
     */
    #[Optional]
    public ?string $instructions;

    /**
     * An identifier for the current login process. Must be passed to execute more steps of the login.
     */
    #[Optional('login_id')]
    public ?string $loginID;

    /**
     * An unique ID identifying this step. This can be used to implement special behavior in clients.
     */
    #[Optional('step_id')]
    public ?string $stepID;

    /**
     * `new UnionMember2()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember2::with(cookies: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember2)->withCookies(...)
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
     * @param Cookies|CookiesShape $cookies
     */
    public static function with(
        Cookies|array $cookies,
        ?string $instructions = null,
        ?string $loginID = null,
        ?string $stepID = null,
    ): self {
        $self = new self;

        $self['cookies'] = $cookies;

        null !== $instructions && $self['instructions'] = $instructions;
        null !== $loginID && $self['loginID'] = $loginID;
        null !== $stepID && $self['stepID'] = $stepID;

        return $self;
    }

    /**
     * Parameters for the cookie login step.
     *
     * @param Cookies|CookiesShape $cookies
     */
    public function withCookies(Cookies|array $cookies): self
    {
        $self = clone $this;
        $self['cookies'] = $cookies;

        return $self;
    }

    /**
     * @param 'cookies' $type
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Human-readable instructions for completing this login step.
     */
    public function withInstructions(string $instructions): self
    {
        $self = clone $this;
        $self['instructions'] = $instructions;

        return $self;
    }

    /**
     * An identifier for the current login process. Must be passed to execute more steps of the login.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }

    /**
     * An unique ID identifying this step. This can be used to implement special behavior in clients.
     */
    public function withStepID(string $stepID): self
    {
        $self = clone $this;
        $self['stepID'] = $stepID;

        return $self;
    }
}
