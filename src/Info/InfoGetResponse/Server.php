<?php

declare(strict_types=1);

namespace BeeperDesktop\Info\InfoGetResponse;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type ServerShape = array{
 *   baseURL: string,
 *   hostname: string,
 *   mcpEnabled: bool,
 *   port: int,
 *   remoteAccess: bool,
 *   status: string,
 * }
 */
final class Server implements BaseModel
{
    /** @use SdkModel<ServerShape> */
    use SdkModel;

    /**
     * Base URL of the Beeper Desktop API server.
     */
    #[Required('base_url')]
    public string $baseURL;

    /**
     * Listening host.
     */
    #[Required]
    public string $hostname;

    /**
     * Whether MCP endpoint is enabled.
     */
    #[Required('mcp_enabled')]
    public bool $mcpEnabled;

    /**
     * Listening port.
     */
    #[Required]
    public int $port;

    /**
     * Whether remote access is enabled.
     */
    #[Required('remote_access')]
    public bool $remoteAccess;

    /**
     * Server status.
     */
    #[Required]
    public string $status;

    /**
     * `new Server()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Server::with(
     *   baseURL: ...,
     *   hostname: ...,
     *   mcpEnabled: ...,
     *   port: ...,
     *   remoteAccess: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Server)
     *   ->withBaseURL(...)
     *   ->withHostname(...)
     *   ->withMcpEnabled(...)
     *   ->withPort(...)
     *   ->withRemoteAccess(...)
     *   ->withStatus(...)
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
     */
    public static function with(
        string $baseURL,
        string $hostname,
        bool $mcpEnabled,
        int $port,
        bool $remoteAccess,
        string $status,
    ): self {
        $self = new self;

        $self['baseURL'] = $baseURL;
        $self['hostname'] = $hostname;
        $self['mcpEnabled'] = $mcpEnabled;
        $self['port'] = $port;
        $self['remoteAccess'] = $remoteAccess;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Base URL of the Beeper Desktop API server.
     */
    public function withBaseURL(string $baseURL): self
    {
        $self = clone $this;
        $self['baseURL'] = $baseURL;

        return $self;
    }

    /**
     * Listening host.
     */
    public function withHostname(string $hostname): self
    {
        $self = clone $this;
        $self['hostname'] = $hostname;

        return $self;
    }

    /**
     * Whether MCP endpoint is enabled.
     */
    public function withMcpEnabled(bool $mcpEnabled): self
    {
        $self = clone $this;
        $self['mcpEnabled'] = $mcpEnabled;

        return $self;
    }

    /**
     * Listening port.
     */
    public function withPort(int $port): self
    {
        $self = clone $this;
        $self['port'] = $port;

        return $self;
    }

    /**
     * Whether remote access is enabled.
     */
    public function withRemoteAccess(bool $remoteAccess): self
    {
        $self = clone $this;
        $self['remoteAccess'] = $remoteAccess;

        return $self;
    }

    /**
     * Server status.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
