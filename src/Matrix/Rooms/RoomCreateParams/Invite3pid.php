<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\RoomCreateParams;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type Invite3pidShape = array{
 *   address: string, idAccessToken: string, idServer: string, medium: string
 * }
 */
final class Invite3pid implements BaseModel
{
    /** @use SdkModel<Invite3pidShape> */
    use SdkModel;

    /**
     * The invitee's third-party identifier.
     */
    #[Required]
    public string $address;

    /**
     * An access token previously registered with the identity server. Servers
     * can treat this as optional to distinguish between r0.5-compatible clients
     * and this specification version.
     */
    #[Required('id_access_token')]
    public string $idAccessToken;

    /**
     * The hostname+port of the identity server which should be used for third-party identifier lookups.
     */
    #[Required('id_server')]
    public string $idServer;

    /**
     * The kind of address being passed in the address field, for example `email`
     * (see [the list of recognised values](https://spec.matrix.org/v1.18/appendices/#3pid-types)).
     */
    #[Required]
    public string $medium;

    /**
     * `new Invite3pid()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Invite3pid::with(address: ..., idAccessToken: ..., idServer: ..., medium: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Invite3pid)
     *   ->withAddress(...)
     *   ->withIDAccessToken(...)
     *   ->withIDServer(...)
     *   ->withMedium(...)
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
        string $address,
        string $idAccessToken,
        string $idServer,
        string $medium
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['idAccessToken'] = $idAccessToken;
        $self['idServer'] = $idServer;
        $self['medium'] = $medium;

        return $self;
    }

    /**
     * The invitee's third-party identifier.
     */
    public function withAddress(string $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * An access token previously registered with the identity server. Servers
     * can treat this as optional to distinguish between r0.5-compatible clients
     * and this specification version.
     */
    public function withIDAccessToken(string $idAccessToken): self
    {
        $self = clone $this;
        $self['idAccessToken'] = $idAccessToken;

        return $self;
    }

    /**
     * The hostname+port of the identity server which should be used for third-party identifier lookups.
     */
    public function withIDServer(string $idServer): self
    {
        $self = clone $this;
        $self['idServer'] = $idServer;

        return $self;
    }

    /**
     * The kind of address being passed in the address field, for example `email`
     * (see [the list of recognised values](https://spec.matrix.org/v1.18/appendices/#3pid-types)).
     */
    public function withMedium(string $medium): self
    {
        $self = clone $this;
        $self['medium'] = $medium;

        return $self;
    }
}
