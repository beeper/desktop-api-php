<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Users\UserSearchResponse;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * A successfully resolved identifier.
 *
 * @phpstan-type ResultShape = array{
 *   id: string,
 *   avatarURL?: string|null,
 *   dmRoomMxid?: string|null,
 *   identifiers?: list<string>|null,
 *   mxid?: string|null,
 *   name?: string|null,
 * }
 */
final class Result implements BaseModel
{
    /** @use SdkModel<ResultShape> */
    use SdkModel;

    /**
     * The internal user ID of the resolved user.
     */
    #[Required]
    public string $id;

    /**
     * The avatar of the user on the remote network.
     */
    #[Optional('avatar_url')]
    public ?string $avatarURL;

    /**
     * The Matrix room ID of the direct chat with the user.
     */
    #[Optional('dm_room_mxid')]
    public ?string $dmRoomMxid;

    /**
     * A list of identifiers for the user on the remote network.
     *
     * @var list<string>|null $identifiers
     */
    #[Optional(list: 'string')]
    public ?array $identifiers;

    /**
     * The Matrix user ID of the ghost representing the user.
     */
    #[Optional]
    public ?string $mxid;

    /**
     * The name of the user on the remote network.
     */
    #[Optional]
    public ?string $name;

    /**
     * `new Result()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Result::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Result)->withID(...)
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
     * @param list<string>|null $identifiers
     */
    public static function with(
        string $id,
        ?string $avatarURL = null,
        ?string $dmRoomMxid = null,
        ?array $identifiers = null,
        ?string $mxid = null,
        ?string $name = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $avatarURL && $self['avatarURL'] = $avatarURL;
        null !== $dmRoomMxid && $self['dmRoomMxid'] = $dmRoomMxid;
        null !== $identifiers && $self['identifiers'] = $identifiers;
        null !== $mxid && $self['mxid'] = $mxid;
        null !== $name && $self['name'] = $name;

        return $self;
    }

    /**
     * The internal user ID of the resolved user.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The avatar of the user on the remote network.
     */
    public function withAvatarURL(string $avatarURL): self
    {
        $self = clone $this;
        $self['avatarURL'] = $avatarURL;

        return $self;
    }

    /**
     * The Matrix room ID of the direct chat with the user.
     */
    public function withDmRoomMxid(string $dmRoomMxid): self
    {
        $self = clone $this;
        $self['dmRoomMxid'] = $dmRoomMxid;

        return $self;
    }

    /**
     * A list of identifiers for the user on the remote network.
     *
     * @param list<string> $identifiers
     */
    public function withIdentifiers(array $identifiers): self
    {
        $self = clone $this;
        $self['identifiers'] = $identifiers;

        return $self;
    }

    /**
     * The Matrix user ID of the ghost representing the user.
     */
    public function withMxid(string $mxid): self
    {
        $self = clone $this;
        $self['mxid'] = $mxid;

        return $self;
    }

    /**
     * The name of the user on the remote network.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }
}
