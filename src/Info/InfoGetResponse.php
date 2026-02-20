<?php

declare(strict_types=1);

namespace BeeperDesktop\Info;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Info\InfoGetResponse\App;
use BeeperDesktop\Info\InfoGetResponse\Endpoints;
use BeeperDesktop\Info\InfoGetResponse\Platform;
use BeeperDesktop\Info\InfoGetResponse\Server;

/**
 * @phpstan-import-type AppShape from \BeeperDesktop\Info\InfoGetResponse\App
 * @phpstan-import-type EndpointsShape from \BeeperDesktop\Info\InfoGetResponse\Endpoints
 * @phpstan-import-type PlatformShape from \BeeperDesktop\Info\InfoGetResponse\Platform
 * @phpstan-import-type ServerShape from \BeeperDesktop\Info\InfoGetResponse\Server
 *
 * @phpstan-type InfoGetResponseShape = array{
 *   app: App|AppShape,
 *   endpoints: Endpoints|EndpointsShape,
 *   platform: Platform|PlatformShape,
 *   server: Server|ServerShape,
 * }
 */
final class InfoGetResponse implements BaseModel
{
    /** @use SdkModel<InfoGetResponseShape> */
    use SdkModel;

    #[Required]
    public App $app;

    #[Required]
    public Endpoints $endpoints;

    #[Required]
    public Platform $platform;

    #[Required]
    public Server $server;

    /**
     * `new InfoGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InfoGetResponse::with(app: ..., endpoints: ..., platform: ..., server: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InfoGetResponse)
     *   ->withApp(...)
     *   ->withEndpoints(...)
     *   ->withPlatform(...)
     *   ->withServer(...)
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
     * @param App|AppShape $app
     * @param Endpoints|EndpointsShape $endpoints
     * @param Platform|PlatformShape $platform
     * @param Server|ServerShape $server
     */
    public static function with(
        App|array $app,
        Endpoints|array $endpoints,
        Platform|array $platform,
        Server|array $server,
    ): self {
        $self = new self;

        $self['app'] = $app;
        $self['endpoints'] = $endpoints;
        $self['platform'] = $platform;
        $self['server'] = $server;

        return $self;
    }

    /**
     * @param App|AppShape $app
     */
    public function withApp(App|array $app): self
    {
        $self = clone $this;
        $self['app'] = $app;

        return $self;
    }

    /**
     * @param Endpoints|EndpointsShape $endpoints
     */
    public function withEndpoints(Endpoints|array $endpoints): self
    {
        $self = clone $this;
        $self['endpoints'] = $endpoints;

        return $self;
    }

    /**
     * @param Platform|PlatformShape $platform
     */
    public function withPlatform(Platform|array $platform): self
    {
        $self = clone $this;
        $self['platform'] = $platform;

        return $self;
    }

    /**
     * @param Server|ServerShape $server
     */
    public function withServer(Server|array $server): self
    {
        $self = clone $this;
        $self['server'] = $server;

        return $self;
    }
}
