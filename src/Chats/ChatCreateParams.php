<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\ChatCreateParams\Mode;
use BeeperDesktop\Chats\ChatCreateParams\Type;
use BeeperDesktop\Chats\ChatCreateParams\User;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Create a direct or group chat with mode="create", or use mode="start" to resolve a contact and open a direct chat.
 *
 * @see BeeperDesktop\Services\ChatsService::create()
 *
 * @phpstan-import-type UserShape from \BeeperDesktop\Chats\ChatCreateParams\User
 *
 * @phpstan-type ChatCreateParamsShape = array{
 *   accountID: string,
 *   allowInvite?: bool|null,
 *   messageText?: string|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   participantIDs?: list<string>|null,
 *   title?: string|null,
 *   type?: null|Type|value-of<Type>,
 *   user?: null|User|UserShape,
 * }
 */
final class ChatCreateParams implements BaseModel
{
    /** @use SdkModel<ChatCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Account to create or start the chat on.
     */
    #[Required]
    public string $accountID;

    /**
     * Only used for mode='start'. Whether invite-based DM creation is allowed when required by the platform.
     */
    #[Optional]
    public ?bool $allowInvite;

    /**
     * Optional first message content if the platform requires it to create the chat.
     */
    #[Optional]
    public ?string $messageText;

    /**
     * Operation mode. Use 'start' to resolve a user/contact and start a direct chat. Omit or set 'create' to create a chat directly.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Required for create mode. Provide exactly one user ID for 'single' chats and one or more for 'group' chats.
     *
     * @var list<string>|null $participantIDs
     */
    #[Optional(list: 'string')]
    public ?array $participantIDs;

    /**
     * Optional title for group chats; ignored for single chats on most networks.
     */
    #[Optional]
    public ?string $title;

    /**
     * Required for create mode. 'single' creates a direct message chat; 'group' creates a group chat.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Required for mode='start'. Merged user-like contact payload used to resolve the best identifier.
     */
    #[Optional]
    public ?User $user;

    /**
     * `new ChatCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatCreateParams::with(accountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatCreateParams)->withAccountID(...)
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
     * @param Mode|value-of<Mode>|null $mode
     * @param list<string>|null $participantIDs
     * @param Type|value-of<Type>|null $type
     * @param User|UserShape|null $user
     */
    public static function with(
        string $accountID,
        ?bool $allowInvite = null,
        ?string $messageText = null,
        Mode|string|null $mode = null,
        ?array $participantIDs = null,
        ?string $title = null,
        Type|string|null $type = null,
        User|array|null $user = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;

        null !== $allowInvite && $self['allowInvite'] = $allowInvite;
        null !== $messageText && $self['messageText'] = $messageText;
        null !== $mode && $self['mode'] = $mode;
        null !== $participantIDs && $self['participantIDs'] = $participantIDs;
        null !== $title && $self['title'] = $title;
        null !== $type && $self['type'] = $type;
        null !== $user && $self['user'] = $user;

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
     * Only used for mode='start'. Whether invite-based DM creation is allowed when required by the platform.
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

    /**
     * Operation mode. Use 'start' to resolve a user/contact and start a direct chat. Omit or set 'create' to create a chat directly.
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
     * Required for create mode. Provide exactly one user ID for 'single' chats and one or more for 'group' chats.
     *
     * @param list<string> $participantIDs
     */
    public function withParticipantIDs(array $participantIDs): self
    {
        $self = clone $this;
        $self['participantIDs'] = $participantIDs;

        return $self;
    }

    /**
     * Optional title for group chats; ignored for single chats on most networks.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Required for create mode. 'single' creates a direct message chat; 'group' creates a group chat.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Required for mode='start'. Merged user-like contact payload used to resolve the best identifier.
     *
     * @param User|UserShape $user
     */
    public function withUser(User|array $user): self
    {
        $self = clone $this;
        $self['user'] = $user;

        return $self;
    }
}
