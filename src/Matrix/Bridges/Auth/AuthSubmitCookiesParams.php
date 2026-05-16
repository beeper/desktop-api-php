<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Submit extracted cookies in a login process.
 *
 * @see BeeperDesktop\Services\Matrix\Bridges\AuthService::submitCookies()
 *
 * @phpstan-type AuthSubmitCookiesParamsShape = array{
 *   bridgeID: string, loginProcessID: string, body: array<string,string>
 * }
 */
final class AuthSubmitCookiesParams implements BaseModel
{
    /** @use SdkModel<AuthSubmitCookiesParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $bridgeID;

    #[Required]
    public string $loginProcessID;

    /** @var array<string,string> $body */
    #[Required(map: 'string')]
    public array $body;

    /**
     * `new AuthSubmitCookiesParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthSubmitCookiesParams::with(bridgeID: ..., loginProcessID: ..., body: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthSubmitCookiesParams)
     *   ->withBridgeID(...)
     *   ->withLoginProcessID(...)
     *   ->withBody(...)
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
     * @param array<string,string> $body
     */
    public static function with(
        string $bridgeID,
        string $loginProcessID,
        array $body
    ): self {
        $self = new self;

        $self['bridgeID'] = $bridgeID;
        $self['loginProcessID'] = $loginProcessID;
        $self['body'] = $body;

        return $self;
    }

    public function withBridgeID(string $bridgeID): self
    {
        $self = clone $this;
        $self['bridgeID'] = $bridgeID;

        return $self;
    }

    public function withLoginProcessID(string $loginProcessID): self
    {
        $self = clone $this;
        $self['loginProcessID'] = $loginProcessID;

        return $self;
    }

    /**
     * @param array<string,string> $body
     */
    public function withBody(array $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }
}
