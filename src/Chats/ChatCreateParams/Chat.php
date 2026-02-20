<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams;

use BeeperDesktop\Chats\ChatCreateParams\Chat\Mode;
use BeeperDesktop\Chats\ChatCreateParams\Chat\Type;
use BeeperDesktop\Chats\ChatCreateParams\Chat\User;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type UserShape from \BeeperDesktop\Chats\ChatCreateParams\Chat\User
 *
 * @phpstan-type ChatShape = array{
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
final class Chat implements BaseModel
{
    /** @use SdkModel<ChatShape> */
    use SdkModel;

    /**
     * Account to create or start the chat on.
     */
    #[Required]
    public string $accountID;

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
     * Operation mode. Defaults to 'create' when omitted.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Required when mode='create'. User IDs to include in the new chat.
     *
     * @var list<string>|null $participantIDs
     */
    #[Optional(list: 'string')]
    public ?array $participantIDs;

    /**
     * Optional title for group chats when mode='create'; ignored for single chats on most platforms.
     */
    #[Optional]
    public ?string $title;

    /**
     * Required when mode='create'. 'single' requires exactly one participantID; 'group' supports multiple participants and optional title.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * Required when mode='start'. Merged user-like contact payload used to resolve the best identifier.
     */
    #[Optional]
    public ?User $user;

    /**
     * `new Chat()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Chat::with(accountID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Chat)->withAccountID(...)
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

    /**
     * Operation mode. Defaults to 'create' when omitted.
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
     * Required when mode='create'. User IDs to include in the new chat.
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
     * Optional title for group chats when mode='create'; ignored for single chats on most platforms.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Required when mode='create'. 'single' requires exactly one participantID; 'group' supports multiple participants and optional title.
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
     * Required when mode='start'. Merged user-like contact payload used to resolve the best identifier.
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
