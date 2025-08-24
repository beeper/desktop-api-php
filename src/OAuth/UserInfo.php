<?php

declare(strict_types=1);

namespace BeeperDesktop\OAuth;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\OAuth\UserInfo\TokenUse;

final class UserInfo implements BaseModel
{
    use SdkModel;

    /**
     * Issued at timestamp (Unix epoch seconds).
     */
    #[Api]
    public float $iat;

    /**
     * Granted scopes.
     */
    #[Api]
    public string $scope;

    /**
     * Subject identifier (token ID).
     */
    #[Api]
    public string $sub;

    /**
     * Token type.
     *
     * @var TokenUse::* $tokenUse
     */
    #[Api('token_use', enum: TokenUse::class)]
    public string $tokenUse;

    /**
     * Audience (client ID).
     */
    #[Api(optional: true)]
    public ?string $aud;

    /**
     * Client identifier.
     */
    #[Api('client_id', optional: true)]
    public ?string $clientID;

    /**
     * Expiration timestamp (Unix epoch seconds).
     */
    #[Api(optional: true)]
    public ?float $exp;

    /**
     * `new UserInfo()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UserInfo::with(iat: ..., scope: ..., sub: ..., tokenUse: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UserInfo)->withIat(...)->withScope(...)->withSub(...)->withTokenUse(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param TokenUse::* $tokenUse
     */
    public static function with(
        float $iat,
        string $scope,
        string $sub,
        string $tokenUse,
        ?string $aud = null,
        ?string $clientID = null,
        ?float $exp = null,
    ): self {
        $obj = new self;

        $obj->iat = $iat;
        $obj->scope = $scope;
        $obj->sub = $sub;
        $obj->tokenUse = $tokenUse;

        null !== $aud && $obj->aud = $aud;
        null !== $clientID && $obj->clientID = $clientID;
        null !== $exp && $obj->exp = $exp;

        return $obj;
    }

    /**
     * Issued at timestamp (Unix epoch seconds).
     */
    public function withIat(float $iat): self
    {
        $obj = clone $this;
        $obj->iat = $iat;

        return $obj;
    }

    /**
     * Granted scopes.
     */
    public function withScope(string $scope): self
    {
        $obj = clone $this;
        $obj->scope = $scope;

        return $obj;
    }

    /**
     * Subject identifier (token ID).
     */
    public function withSub(string $sub): self
    {
        $obj = clone $this;
        $obj->sub = $sub;

        return $obj;
    }

    /**
     * Token type.
     *
     * @param TokenUse::* $tokenUse
     */
    public function withTokenUse(string $tokenUse): self
    {
        $obj = clone $this;
        $obj->tokenUse = $tokenUse;

        return $obj;
    }

    /**
     * Audience (client ID).
     */
    public function withAud(string $aud): self
    {
        $obj = clone $this;
        $obj->aud = $aud;

        return $obj;
    }

    /**
     * Client identifier.
     */
    public function withClientID(string $clientID): self
    {
        $obj = clone $this;
        $obj->clientID = $clientID;

        return $obj;
    }

    /**
     * Expiration timestamp (Unix epoch seconds).
     */
    public function withExp(float $exp): self
    {
        $obj = clone $this;
        $obj->exp = $exp;

        return $obj;
    }
}
