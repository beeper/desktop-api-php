<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\ChatStartParams\User;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Resolve a user/contact and open a direct chat. Reuses and returns an existing direct chat when one is found. Available in Beeper Desktop v4.2.808+.
 *
 * @see BeeperDesktop\Services\ChatsService::start()
 *
 * @phpstan-import-type UserShape from \BeeperDesktop\Chats\ChatStartParams\User
 *
 * @phpstan-type ChatStartParamsShape = array{
 *   accountID: string,
 *   user: User|UserShape,
 *   allowInvite?: bool|null,
 *   messageText?: string|null,
 * }
 */
final class ChatStartParams implements BaseModel
{
    /** @use SdkModel<ChatStartParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Account to create or start the chat on.
     */
    #[Required]
    public string $accountID;

    /**
     * Merged user-like contact payload used to resolve the best identifier.
     */
    #[Required]
    public User $user;

    /**
     * Whether invite-based DM creation is allowed when required by the platform.
     */
    #[Optional]
    public ?bool $allowInvite;

    /**
     * Optional first message content if the platform requires it to create the chat.
     */
    #[Optional]
    public ?string $messageText;

    /**
     * `new ChatStartParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatStartParams::with(accountID: ..., user: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatStartParams)->withAccountID(...)->withUser(...)
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
     * @param User|UserShape $user
     */
    public static function with(
        string $accountID,
        User|array $user,
        ?bool $allowInvite = null,
        ?string $messageText = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
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
     * Whether invite-based DM creation is allowed when required by the platform.
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
