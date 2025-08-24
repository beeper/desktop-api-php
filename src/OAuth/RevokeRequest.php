<?php

declare(strict_types=1);

namespace BeeperDesktop\OAuth;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\OAuth\RevokeRequest\TokenTypeHint;

final class RevokeRequest implements BaseModel
{
    use SdkModel;

    /**
     * The token to revoke.
     */
    #[Api]
    public string $token;

    /**
     * Hint about the type of token being revoked.
     *
     * @var TokenTypeHint::*|null $tokenTypeHint
     */
    #[Api('token_type_hint', enum: TokenTypeHint::class, optional: true)]
    public ?string $tokenTypeHint;

    /**
     * `new RevokeRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RevokeRequest::with(token: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RevokeRequest)->withToken(...)
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
     * @param TokenTypeHint::* $tokenTypeHint
     */
    public static function with(
        string $token,
        ?string $tokenTypeHint = null
    ): self {
        $obj = new self;

        $obj->token = $token;

        null !== $tokenTypeHint && $obj->tokenTypeHint = $tokenTypeHint;

        return $obj;
    }

    /**
     * The token to revoke.
     */
    public function withToken(string $token): self
    {
        $obj = clone $this;
        $obj->token = $token;

        return $obj;
    }

    /**
     * Hint about the type of token being revoked.
     *
     * @param TokenTypeHint::* $tokenTypeHint
     */
    public function withTokenTypeHint(string $tokenTypeHint): self
    {
        $obj = clone $this;
        $obj->tokenTypeHint = $tokenTypeHint;

        return $obj;
    }
}
