<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Capabilities;

use BeeperDesktop\Chats\Chat\Capabilities\ParticipantActions\Ban;
use BeeperDesktop\Chats\Chat\Capabilities\ParticipantActions\Invite;
use BeeperDesktop\Chats\Chat\Capabilities\ParticipantActions\Kick;
use BeeperDesktop\Chats\Chat\Capabilities\ParticipantActions\Leave;
use BeeperDesktop\Chats\Chat\Capabilities\ParticipantActions\RevokeInvite;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Participant management capabilities.
 *
 * @phpstan-type ParticipantActionsShape = array{
 *   ban?: null|Ban|value-of<Ban>,
 *   invite?: null|Invite|value-of<Invite>,
 *   kick?: null|Kick|value-of<Kick>,
 *   leave?: null|Leave|value-of<Leave>,
 *   revokeInvite?: null|RevokeInvite|value-of<RevokeInvite>,
 * }
 */
final class ParticipantActions implements BaseModel
{
    /** @use SdkModel<ParticipantActionsShape> */
    use SdkModel;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Ban>|null $ban
     */
    #[Optional(enum: Ban::class)]
    public ?int $ban;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Invite>|null $invite
     */
    #[Optional(enum: Invite::class)]
    public ?int $invite;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Kick>|null $kick
     */
    #[Optional(enum: Kick::class)]
    public ?int $kick;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Leave>|null $leave
     */
    #[Optional(enum: Leave::class)]
    public ?int $leave;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<RevokeInvite>|null $revokeInvite
     */
    #[Optional(enum: RevokeInvite::class)]
    public ?int $revokeInvite;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Ban|value-of<Ban>|null $ban
     * @param Invite|value-of<Invite>|null $invite
     * @param Kick|value-of<Kick>|null $kick
     * @param Leave|value-of<Leave>|null $leave
     * @param RevokeInvite|value-of<RevokeInvite>|null $revokeInvite
     */
    public static function with(
        Ban|int|null $ban = null,
        Invite|int|null $invite = null,
        Kick|int|null $kick = null,
        Leave|int|null $leave = null,
        RevokeInvite|int|null $revokeInvite = null,
    ): self {
        $self = new self;

        null !== $ban && $self['ban'] = $ban;
        null !== $invite && $self['invite'] = $invite;
        null !== $kick && $self['kick'] = $kick;
        null !== $leave && $self['leave'] = $leave;
        null !== $revokeInvite && $self['revokeInvite'] = $revokeInvite;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Ban|value-of<Ban> $ban
     */
    public function withBan(Ban|int $ban): self
    {
        $self = clone $this;
        $self['ban'] = $ban;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Invite|value-of<Invite> $invite
     */
    public function withInvite(Invite|int $invite): self
    {
        $self = clone $this;
        $self['invite'] = $invite;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Kick|value-of<Kick> $kick
     */
    public function withKick(Kick|int $kick): self
    {
        $self = clone $this;
        $self['kick'] = $kick;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Leave|value-of<Leave> $leave
     */
    public function withLeave(Leave|int $leave): self
    {
        $self = clone $this;
        $self['leave'] = $leave;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param RevokeInvite|value-of<RevokeInvite> $revokeInvite
     */
    public function withRevokeInvite(RevokeInvite|int $revokeInvite): self
    {
        $self = clone $this;
        $self['revokeInvite'] = $revokeInvite;

        return $self;
    }
}
