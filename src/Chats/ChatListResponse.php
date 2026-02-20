<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\Chat\Participants;
use BeeperDesktop\Chats\Chat\Type;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Message;

/**
 * @phpstan-import-type ParticipantsShape from \BeeperDesktop\Chats\Chat\Participants
 * @phpstan-import-type MessageShape from \BeeperDesktop\Message
 *
 * @phpstan-type ChatListResponseShape = array{
 *   id: string,
 *   accountID: string,
 *   participants: Participants|ParticipantsShape,
 *   title: string,
 *   type: Type|value-of<Type>,
 *   unreadCount: int,
 *   isArchived?: bool|null,
 *   isMuted?: bool|null,
 *   isPinned?: bool|null,
 *   lastActivity?: \DateTimeInterface|null,
 *   lastReadMessageSortKey?: string|null,
 *   localChatID?: string|null,
 *   preview?: null|Message|MessageShape,
 * }
 */
final class ChatListResponse implements BaseModel
{
    /** @use SdkModel<ChatListResponseShape> */
    use SdkModel;

    /**
     * Unique identifier of the chat across Beeper.
     */
    #[Required]
    public string $id;

    /**
     * Account ID this chat belongs to.
     */
    #[Required]
    public string $accountID;

    /**
     * Chat participants information.
     */
    #[Required]
    public Participants $participants;

    /**
     * Display title of the chat as computed by the client/server.
     */
    #[Required]
    public string $title;

    /**
     * Chat type: 'single' for direct messages, 'group' for group chats.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Number of unread messages.
     */
    #[Required]
    public int $unreadCount;

    /**
     * True if chat is archived.
     */
    #[Optional]
    public ?bool $isArchived;

    /**
     * True if chat notifications are muted.
     */
    #[Optional]
    public ?bool $isMuted;

    /**
     * True if chat is pinned.
     */
    #[Optional]
    public ?bool $isPinned;

    /**
     * Timestamp of last activity.
     */
    #[Optional]
    public ?\DateTimeInterface $lastActivity;

    /**
     * Last read message sortKey.
     */
    #[Optional]
    public ?string $lastReadMessageSortKey;

    /**
     * Local chat ID specific to this Beeper Desktop installation.
     */
    #[Optional(nullable: true)]
    public ?string $localChatID;

    #[Optional]
    public ?Message $preview;

    /**
     * `new ChatListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatListResponse::with(
     *   id: ...,
     *   accountID: ...,
     *   participants: ...,
     *   title: ...,
     *   type: ...,
     *   unreadCount: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatListResponse)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withParticipants(...)
     *   ->withTitle(...)
     *   ->withType(...)
     *   ->withUnreadCount(...)
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
     * @param Participants|ParticipantsShape $participants
     * @param Type|value-of<Type> $type
     * @param Message|MessageShape|null $preview
     */
    public static function with(
        string $id,
        string $accountID,
        Participants|array $participants,
        string $title,
        Type|string $type,
        int $unreadCount,
        ?bool $isArchived = null,
        ?bool $isMuted = null,
        ?bool $isPinned = null,
        ?\DateTimeInterface $lastActivity = null,
        ?string $lastReadMessageSortKey = null,
        ?string $localChatID = null,
        Message|array|null $preview = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['participants'] = $participants;
        $self['title'] = $title;
        $self['type'] = $type;
        $self['unreadCount'] = $unreadCount;

        null !== $isArchived && $self['isArchived'] = $isArchived;
        null !== $isMuted && $self['isMuted'] = $isMuted;
        null !== $isPinned && $self['isPinned'] = $isPinned;
        null !== $lastActivity && $self['lastActivity'] = $lastActivity;
        null !== $lastReadMessageSortKey && $self['lastReadMessageSortKey'] = $lastReadMessageSortKey;
        null !== $localChatID && $self['localChatID'] = $localChatID;
        null !== $preview && $self['preview'] = $preview;

        return $self;
    }

    /**
     * Unique identifier of the chat across Beeper.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Account ID this chat belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Chat participants information.
     *
     * @param Participants|ParticipantsShape $participants
     */
    public function withParticipants(Participants|array $participants): self
    {
        $self = clone $this;
        $self['participants'] = $participants;

        return $self;
    }

    /**
     * Display title of the chat as computed by the client/server.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }

    /**
     * Chat type: 'single' for direct messages, 'group' for group chats.
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
     * Number of unread messages.
     */
    public function withUnreadCount(int $unreadCount): self
    {
        $self = clone $this;
        $self['unreadCount'] = $unreadCount;

        return $self;
    }

    /**
     * True if chat is archived.
     */
    public function withIsArchived(bool $isArchived): self
    {
        $self = clone $this;
        $self['isArchived'] = $isArchived;

        return $self;
    }

    /**
     * True if chat notifications are muted.
     */
    public function withIsMuted(bool $isMuted): self
    {
        $self = clone $this;
        $self['isMuted'] = $isMuted;

        return $self;
    }

    /**
     * True if chat is pinned.
     */
    public function withIsPinned(bool $isPinned): self
    {
        $self = clone $this;
        $self['isPinned'] = $isPinned;

        return $self;
    }

    /**
     * Timestamp of last activity.
     */
    public function withLastActivity(\DateTimeInterface $lastActivity): self
    {
        $self = clone $this;
        $self['lastActivity'] = $lastActivity;

        return $self;
    }

    /**
     * Last read message sortKey.
     */
    public function withLastReadMessageSortKey(
        string $lastReadMessageSortKey
    ): self {
        $self = clone $this;
        $self['lastReadMessageSortKey'] = $lastReadMessageSortKey;

        return $self;
    }

    /**
     * Local chat ID specific to this Beeper Desktop installation.
     */
    public function withLocalChatID(?string $localChatID): self
    {
        $self = clone $this;
        $self['localChatID'] = $localChatID;

        return $self;
    }

    /**
     * @param Message|MessageShape $preview
     */
    public function withPreview(Message|array $preview): self
    {
        $self = clone $this;
        $self['preview'] = $preview;

        return $self;
    }
}
