<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Info about the network that the bridge is bridging to.
 *
 * @phpstan-type NetworkShape = array{
 *   beeperBridgeType: string,
 *   displayname: string,
 *   networkIcon: string,
 *   networkID: string,
 *   networkURL: string,
 * }
 */
final class Network implements BaseModel
{
    /** @use SdkModel<NetworkShape> */
    use SdkModel;

    /**
     * An identifier uniquely identifying the bridge software.
     */
    #[Required('beeper_bridge_type')]
    public string $beeperBridgeType;

    /**
     * The displayname of the network.
     */
    #[Required]
    public string $displayname;

    /**
     * The icon of the network as a `mxc://` URI.
     */
    #[Required('network_icon')]
    public string $networkIcon;

    /**
     * An identifier uniquely identifying the network.
     */
    #[Required('network_id')]
    public string $networkID;

    /**
     * The URL to the website of the network.
     */
    #[Required('network_url')]
    public string $networkURL;

    /**
     * `new Network()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Network::with(
     *   beeperBridgeType: ...,
     *   displayname: ...,
     *   networkIcon: ...,
     *   networkID: ...,
     *   networkURL: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Network)
     *   ->withBeeperBridgeType(...)
     *   ->withDisplayname(...)
     *   ->withNetworkIcon(...)
     *   ->withNetworkID(...)
     *   ->withNetworkURL(...)
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
        string $beeperBridgeType,
        string $displayname,
        string $networkIcon,
        string $networkID,
        string $networkURL,
    ): self {
        $self = new self;

        $self['beeperBridgeType'] = $beeperBridgeType;
        $self['displayname'] = $displayname;
        $self['networkIcon'] = $networkIcon;
        $self['networkID'] = $networkID;
        $self['networkURL'] = $networkURL;

        return $self;
    }

    /**
     * An identifier uniquely identifying the bridge software.
     */
    public function withBeeperBridgeType(string $beeperBridgeType): self
    {
        $self = clone $this;
        $self['beeperBridgeType'] = $beeperBridgeType;

        return $self;
    }

    /**
     * The displayname of the network.
     */
    public function withDisplayname(string $displayname): self
    {
        $self = clone $this;
        $self['displayname'] = $displayname;

        return $self;
    }

    /**
     * The icon of the network as a `mxc://` URI.
     */
    public function withNetworkIcon(string $networkIcon): self
    {
        $self = clone $this;
        $self['networkIcon'] = $networkIcon;

        return $self;
    }

    /**
     * An identifier uniquely identifying the network.
     */
    public function withNetworkID(string $networkID): self
    {
        $self = clone $this;
        $self['networkID'] = $networkID;

        return $self;
    }

    /**
     * The URL to the website of the network.
     */
    public function withNetworkURL(string $networkURL): self
    {
        $self = clone $this;
        $self['networkURL'] = $networkURL;

        return $self;
    }
}
