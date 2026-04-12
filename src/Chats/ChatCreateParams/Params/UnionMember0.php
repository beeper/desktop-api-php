<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams\Params;

use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember0\Mode;
use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember0\User;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type UserShape from \BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember0\User
 *
 * @phpstan-type UnionMember0Shape = array{
 *   accountID: string,
 *   mode: Mode|value-of<Mode>,
 *   user: User|UserShape,
 *   allowInvite?: bool|null,
 *   messageText?: string|null,
 * }
 */
final class UnionMember0 implements BaseModel
{
    /** @use SdkModel<UnionMember0Shape> */
    use SdkModel;

    /**
     * Account to create or start the chat on.
     */
    #[Required]
    public string $accountID;

    /**
     * Operation mode. Use 'start' to resolve a user/contact and start a direct chat.
     *
     * @var value-of<Mode> $mode
     */
    #[Required(enum: Mode::class)]
    public string $mode;

    /**
     * Merged user-like contact payload used to resolve the best identifier.
     */
    #[Required]
    public User $user;

    /**
     * Whether invite-based DM creation is allowed when required by the platform. Used for mode='start'.
     */
    #[Optional]
    public ?bool $allowInvite;

    /**
     * Optional first message content if the platform requires it to create the chat.
     */
    #[Optional]
    public ?string $messageText;

    /**
     * `new UnionMember0()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember0::with(accountID: ..., mode: ..., user: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember0)->withAccountID(...)->withMode(...)->withUser(...)
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
     * @param Mode|value-of<Mode> $mode
     * @param User|UserShape $user
     */
    public static function with(
        string $accountID,
        Mode|string $mode,
        User|array $user,
        ?bool $allowInvite = null,
        ?string $messageText = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['mode'] = $mode;
        $self['user'] = $user;

        null !== $allowInvite && $self['allowInvite'] = $allowInvite;
        null !== $messageText && $self['messageText'] = $messageText;

        return $self;
    }

    /**
     * Account to create or start the chat on.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Operation mode. Use 'start' to resolve a user/contact and start a direct chat.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Merged user-like contact payload used to resolve the best identifier.
     *
     * @param User|UserShape $user
     */
    public function withUser(User|array $user): self
    {
        $self = clone $this;
        $self['user'] = $user;

        return $self;
    }

    /**
     * Whether invite-based DM creation is allowed when required by the platform. Used for mode='start'.
     */
    public function withAllowInvite(bool $allowInvite): self
    {
        $self = clone $this;
        $self['allowInvite'] = $allowInvite;

        return $self;
    }

    /**
     * Optional first message content if the platform requires it to create the chat.
     */
    public function withMessageText(string $messageText): self
    {
        $self = clone $this;
        $self['messageText'] = $messageText;

        return $self;
    }
}
