<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\LoginFlow;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Network;

/**
 * Info about the bridge and user.
 *
 * @phpstan-import-type LoginFlowShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\LoginFlow
 * @phpstan-import-type LoginShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login
 * @phpstan-import-type NetworkShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Network
 *
 * @phpstan-type AuthWhoamiResponseShape = array{
 *   bridgeBot: string,
 *   commandPrefix: string,
 *   homeserver: string,
 *   loginFlows: list<LoginFlow|LoginFlowShape>,
 *   logins: list<Login|LoginShape>,
 *   network: Network|NetworkShape,
 *   managementRoom?: string|null,
 * }
 */
final class AuthWhoamiResponse implements BaseModel
{
    /** @use SdkModel<AuthWhoamiResponseShape> */
    use SdkModel;

    /**
     * The Matrix user ID of the bridge bot.
     */
    #[Required('bridge_bot')]
    public string $bridgeBot;

    /**
     * The command prefix used by this bridge.
     */
    #[Required('command_prefix')]
    public string $commandPrefix;

    /**
     * The server name the bridge is running on.
     */
    #[Required]
    public string $homeserver;

    /**
     * The login flows that the bridge supports.
     *
     * @var list<LoginFlow> $loginFlows
     */
    #[Required('login_flows', list: LoginFlow::class)]
    public array $loginFlows;

    /**
     * The logins of the user who made the /whoami call.
     *
     * @var list<Login> $logins
     */
    #[Required(list: Login::class)]
    public array $logins;

    /**
     * Info about the network that the bridge is bridging to.
     */
    #[Required]
    public Network $network;

    /**
     * The Matrix management room ID of the user who made the /whoami call.
     */
    #[Optional('management_room')]
    public ?string $managementRoom;

    /**
     * `new AuthWhoamiResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AuthWhoamiResponse::with(
     *   bridgeBot: ...,
     *   commandPrefix: ...,
     *   homeserver: ...,
     *   loginFlows: ...,
     *   logins: ...,
     *   network: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AuthWhoamiResponse)
     *   ->withBridgeBot(...)
     *   ->withCommandPrefix(...)
     *   ->withHomeserver(...)
     *   ->withLoginFlows(...)
     *   ->withLogins(...)
     *   ->withNetwork(...)
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
     * @param list<LoginFlow|LoginFlowShape> $loginFlows
     * @param list<Login|LoginShape> $logins
     * @param Network|NetworkShape $network
     */
    public static function with(
        string $bridgeBot,
        string $commandPrefix,
        string $homeserver,
        array $loginFlows,
        array $logins,
        Network|array $network,
        ?string $managementRoom = null,
    ): self {
        $self = new self;

        $self['bridgeBot'] = $bridgeBot;
        $self['commandPrefix'] = $commandPrefix;
        $self['homeserver'] = $homeserver;
        $self['loginFlows'] = $loginFlows;
        $self['logins'] = $logins;
        $self['network'] = $network;

        null !== $managementRoom && $self['managementRoom'] = $managementRoom;

        return $self;
    }

    /**
     * The Matrix user ID of the bridge bot.
     */
    public function withBridgeBot(string $bridgeBot): self
    {
        $self = clone $this;
        $self['bridgeBot'] = $bridgeBot;

        return $self;
    }

    /**
     * The command prefix used by this bridge.
     */
    public function withCommandPrefix(string $commandPrefix): self
    {
        $self = clone $this;
        $self['commandPrefix'] = $commandPrefix;

        return $self;
    }

    /**
     * The server name the bridge is running on.
     */
    public function withHomeserver(string $homeserver): self
    {
        $self = clone $this;
        $self['homeserver'] = $homeserver;

        return $self;
    }

    /**
     * The login flows that the bridge supports.
     *
     * @param list<LoginFlow|LoginFlowShape> $loginFlows
     */
    public function withLoginFlows(array $loginFlows): self
    {
        $self = clone $this;
        $self['loginFlows'] = $loginFlows;

        return $self;
    }

    /**
     * The logins of the user who made the /whoami call.
     *
     * @param list<Login|LoginShape> $logins
     */
    public function withLogins(array $logins): self
    {
        $self = clone $this;
        $self['logins'] = $logins;

        return $self;
    }

    /**
     * Info about the network that the bridge is bridging to.
     *
     * @param Network|NetworkShape $network
     */
    public function withNetwork(Network|array $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * The Matrix management room ID of the user who made the /whoami call.
     */
    public function withManagementRoom(string $managementRoom): self
    {
        $self = clone $this;
        $self['managementRoom'] = $managementRoom;

        return $self;
    }
}
