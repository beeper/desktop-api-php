<?php

declare(strict_types=1);

namespace BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0;

use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0\DesktopAPI\Scope;
use BeeperDesktop\App\Login\LoginResponseResponse\UnionMember0\DesktopAPI\TokenType;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Desktop API credentials for the signed-in app session.
 *
 * @phpstan-type DesktopAPIShape = array{
 *   accessToken: string,
 *   scope: Scope|value-of<Scope>,
 *   tokenType: TokenType|value-of<TokenType>,
 * }
 */
final class DesktopAPI implements BaseModel
{
    /** @use SdkModel<DesktopAPIShape> */
    use SdkModel;

    /**
     * Desktop API access token for this app session.
     */
    #[Required]
    public string $accessToken;

    /**
     * Granted Desktop API scopes.
     *
     * @var value-of<Scope> $scope
     */
    #[Required(enum: Scope::class)]
    public string $scope;

    /**
     * Access token type.
     *
     * @var value-of<TokenType> $tokenType
     */
    #[Required(enum: TokenType::class)]
    public string $tokenType;

    /**
     * `new DesktopAPI()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DesktopAPI::with(accessToken: ..., scope: ..., tokenType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DesktopAPI)->withAccessToken(...)->withScope(...)->withTokenType(...)
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
     * @param Scope|value-of<Scope> $scope
     * @param TokenType|value-of<TokenType> $tokenType
     */
    public static function with(
        string $accessToken,
        Scope|string $scope,
        TokenType|string $tokenType
    ): self {
        $self = new self;

        $self['accessToken'] = $accessToken;
        $self['scope'] = $scope;
        $self['tokenType'] = $tokenType;

        return $self;
    }

    /**
     * Desktop API access token for this app session.
     */
    public function withAccessToken(string $accessToken): self
    {
        $self = clone $this;
        $self['accessToken'] = $accessToken;

        return $self;
    }

    /**
     * Granted Desktop API scopes.
     *
     * @param Scope|value-of<Scope> $scope
     */
    public function withScope(Scope|string $scope): self
    {
        $self = clone $this;
        $self['scope'] = $scope;

        return $self;
    }

    /**
     * Access token type.
     *
     * @param TokenType|value-of<TokenType> $tokenType
     */
    public function withTokenType(TokenType|string $tokenType): self
    {
        $self = clone $this;
        $self['tokenType'] = $tokenType;

        return $self;
    }
}
