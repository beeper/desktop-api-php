<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login\Profile;
use BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login\State;

/**
 * The info of an individual login.
 *
 * @phpstan-import-type ProfileShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login\Profile
 * @phpstan-import-type StateShape from \BeeperDesktop\Matrix\Bridges\Auth\AuthWhoamiResponse\Login\State
 *
 * @phpstan-type LoginShape = array{
 *   id: string,
 *   name: string,
 *   profile: Profile|ProfileShape,
 *   state: State|StateShape,
 *   spaceRoom?: string|null,
 * }
 */
final class Login implements BaseModel
{
    /** @use SdkModel<LoginShape> */
    use SdkModel;

    /**
     * The unique ID of a login. Defined by the network connector.
     */
    #[Required]
    public string $id;

    /**
     * A human-readable name for the login. Defined by the network connector.
     */
    #[Required]
    public string $name;

    /**
     * The profile info of the logged-in user on the remote network.
     */
    #[Required]
    public Profile $profile;

    /**
     * The connection status of an individual login.
     */
    #[Required]
    public State $state;

    /**
     * The personal filtering space room ID for this login.
     */
    #[Optional('space_room')]
    public ?string $spaceRoom;

    /**
     * `new Login()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Login::with(id: ..., name: ..., profile: ..., state: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Login)->withID(...)->withName(...)->withProfile(...)->withState(...)
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
     * @param Profile|ProfileShape $profile
     * @param State|StateShape $state
     */
    public static function with(
        string $id,
        string $name,
        Profile|array $profile,
        State|array $state,
        ?string $spaceRoom = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['name'] = $name;
        $self['profile'] = $profile;
        $self['state'] = $state;

        null !== $spaceRoom && $self['spaceRoom'] = $spaceRoom;

        return $self;
    }

    /**
     * The unique ID of a login. Defined by the network connector.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * A human-readable name for the login. Defined by the network connector.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The profile info of the logged-in user on the remote network.
     *
     * @param Profile|ProfileShape $profile
     */
    public function withProfile(Profile|array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * The connection status of an individual login.
     *
     * @param State|StateShape $state
     */
    public function withState(State|array $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The personal filtering space room ID for this login.
     */
    public function withSpaceRoom(string $spaceRoom): self
    {
        $self = clone $this;
        $self['spaceRoom'] = $spaceRoom;

        return $self;
    }
}
