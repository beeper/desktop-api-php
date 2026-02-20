<?php

declare(strict_types=1);

namespace BeeperDesktop\Info\InfoGetResponse;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Info\InfoGetResponse\Endpoints\OAuth;

/**
 * @phpstan-import-type OAuthShape from \BeeperDesktop\Info\InfoGetResponse\Endpoints\OAuth
 *
 * @phpstan-type EndpointsShape = array{
 *   mcp: string, oauth: OAuth|OAuthShape, spec: string, wsEvents: string
 * }
 */
final class Endpoints implements BaseModel
{
    /** @use SdkModel<EndpointsShape> */
    use SdkModel;

    /**
     * MCP endpoint.
     */
    #[Required]
    public string $mcp;

    #[Required]
    public OAuth $oauth;

    /**
     * OpenAPI spec endpoint.
     */
    #[Required]
    public string $spec;

    /**
     * WebSocket events endpoint.
     */
    #[Required('ws_events')]
    public string $wsEvents;

    /**
     * `new Endpoints()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Endpoints::with(mcp: ..., oauth: ..., spec: ..., wsEvents: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Endpoints)->withMcp(...)->withOAuth(...)->withSpec(...)->withWsEvents(...)
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
     * @param OAuth|OAuthShape $oauth
     */
    public static function with(
        string $mcp,
        OAuth|array $oauth,
        string $spec,
        string $wsEvents
    ): self {
        $self = new self;

        $self['mcp'] = $mcp;
        $self['oauth'] = $oauth;
        $self['spec'] = $spec;
        $self['wsEvents'] = $wsEvents;

        return $self;
    }

    /**
     * MCP endpoint.
     */
    public function withMcp(string $mcp): self
    {
        $self = clone $this;
        $self['mcp'] = $mcp;

        return $self;
    }

    /**
     * @param OAuth|OAuthShape $oauth
     */
    public function withOAuth(OAuth|array $oauth): self
    {
        $self = clone $this;
        $self['oauth'] = $oauth;

        return $self;
    }

    /**
     * OpenAPI spec endpoint.
     */
    public function withSpec(string $spec): self
    {
        $self = clone $this;
        $self['spec'] = $spec;

        return $self;
    }

    /**
     * WebSocket events endpoint.
     */
    public function withWsEvents(string $wsEvents): self
    {
        $self = clone $this;
        $self['wsEvents'] = $wsEvents;

        return $self;
    }
}
