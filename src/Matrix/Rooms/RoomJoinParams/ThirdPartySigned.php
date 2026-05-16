<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Rooms\RoomJoinParams;

use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Core\Conversion\MapOf;

/**
 * A signature of an `m.third_party_invite` token to prove that this user
 * owns a third-party identity which has been invited to the room.
 *
 * @phpstan-type ThirdPartySignedShape = array{
 *   token: string,
 *   mxid: string,
 *   sender: string,
 *   signatures: array<string,array<string,string>>,
 * }
 */
final class ThirdPartySigned implements BaseModel
{
    /** @use SdkModel<ThirdPartySignedShape> */
    use SdkModel;

    /**
     * The state key of the m.third_party_invite event.
     */
    #[Required]
    public string $token;

    /**
     * The Matrix ID of the invitee.
     */
    #[Required]
    public string $mxid;

    /**
     * The Matrix ID of the user who issued the invite.
     */
    #[Required]
    public string $sender;

    /**
     * A signatures object containing a signature of the entire signed object.
     *
     * @var array<string,array<string,string>> $signatures
     */
    #[Required(map: new MapOf('string'))]
    public array $signatures;

    /**
     * `new ThirdPartySigned()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ThirdPartySigned::with(token: ..., mxid: ..., sender: ..., signatures: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ThirdPartySigned)
     *   ->withToken(...)
     *   ->withMxid(...)
     *   ->withSender(...)
     *   ->withSignatures(...)
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
     * @param array<string,array<string,string>> $signatures
     */
    public static function with(
        string $token,
        string $mxid,
        string $sender,
        array $signatures
    ): self {
        $self = new self;

        $self['token'] = $token;
        $self['mxid'] = $mxid;
        $self['sender'] = $sender;
        $self['signatures'] = $signatures;

        return $self;
    }

    /**
     * The state key of the m.third_party_invite event.
     */
    public function withToken(string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * The Matrix ID of the invitee.
     */
    public function withMxid(string $mxid): self
    {
        $self = clone $this;
        $self['mxid'] = $mxid;

        return $self;
    }

    /**
     * The Matrix ID of the user who issued the invite.
     */
    public function withSender(string $sender): self
    {
        $self = clone $this;
        $self['sender'] = $sender;

        return $self;
    }

    /**
     * A signatures object containing a signature of the entire signed object.
     *
     * @param array<string,array<string,string>> $signatures
     */
    public function withSignatures(array $signatures): self
    {
        $self = clone $this;
        $self['signatures'] = $signatures;

        return $self;
    }
}
