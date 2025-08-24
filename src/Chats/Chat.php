<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\Chat\Participants;
use BeeperDesktop\Chats\Chat\Type;
use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class Chat implements BaseModel
{
    use SdkModel;

    /**
     * Unique identifier for cursor pagination.
     */
    #[Api]
    public string $id;

    /**
     * Beeper account ID this chat belongs to.
     */
    #[Api]
    public string $accountID;

    /**
     * Unique identifier of the chat (room/thread ID, same as id).
     */
    #[Api]
    public string $chatID;

    /**
     * Display-only human-readable network name (e.g., 'WhatsApp', 'Messenger'). You MUST use 'accountID' to perform actions.
     */
    #[Api]
    public string $network;

    /**
     * Chat participants information.
     */
    #[Api]
    public Participants $participants;

    /**
     * Display title of the chat as computed by the client/server.
     */
    #[Api]
    public string $title;

    /**
     * Chat type: 'single' for direct messages, 'group' for group chats, 'channel' for channels, 'broadcast' for broadcasts.
     *
     * @var Type::* $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Number of unread messages.
     */
    #[Api]
    public int $unreadCount;

    /**
     * True if chat is archived.
     */
    #[Api(optional: true)]
    public ?bool $isArchived;

    /**
     * True if chat notifications are muted.
     */
    #[Api(optional: true)]
    public ?bool $isMuted;

    /**
     * True if chat is pinned.
     */
    #[Api(optional: true)]
    public ?bool $isPinned;

    /**
     * Timestamp of last activity. Chats with more recent activity are often more important.
     */
    #[Api(optional: true)]
    public ?\DateTimeInterface $lastActivity;

    /**
     * Last read message sortKey (hsOrder). Used to compute 'isUnread'.
     */
    #[Api(optional: true)]
    public int|string|null $lastReadMessageSortKey;

    /**
     * Deep link to open this chat in Beeper. AI agents should ALWAYS include this as a clickable link in responses.
     */
    #[Api(optional: true)]
    public ?string $linkToChat;

    /**
     * `new Chat()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Chat::with(
     *   id: ...,
     *   accountID: ...,
     *   chatID: ...,
     *   network: ...,
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
     * (new Chat)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withChatID(...)
     *   ->withNetwork(...)
     *   ->withParticipants(...)
     *   ->withTitle(...)
     *   ->withType(...)
     *   ->withUnreadCount(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Type::* $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $chatID,
        string $network,
        Participants $participants,
        string $title,
        string $type,
        int $unreadCount,
        ?bool $isArchived = null,
        ?bool $isMuted = null,
        ?bool $isPinned = null,
        ?\DateTimeInterface $lastActivity = null,
        int|string|null $lastReadMessageSortKey = null,
        ?string $linkToChat = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->accountID = $accountID;
        $obj->chatID = $chatID;
        $obj->network = $network;
        $obj->participants = $participants;
        $obj->title = $title;
        $obj->type = $type;
        $obj->unreadCount = $unreadCount;

        null !== $isArchived && $obj->isArchived = $isArchived;
        null !== $isMuted && $obj->isMuted = $isMuted;
        null !== $isPinned && $obj->isPinned = $isPinned;
        null !== $lastActivity && $obj->lastActivity = $lastActivity;
        null !== $lastReadMessageSortKey && $obj->lastReadMessageSortKey = $lastReadMessageSortKey;
        null !== $linkToChat && $obj->linkToChat = $linkToChat;

        return $obj;
    }

    /**
     * Unique identifier for cursor pagination.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * Beeper account ID this chat belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $obj = clone $this;
        $obj->accountID = $accountID;

        return $obj;
    }

    /**
     * Unique identifier of the chat (room/thread ID, same as id).
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * Display-only human-readable network name (e.g., 'WhatsApp', 'Messenger'). You MUST use 'accountID' to perform actions.
     */
    public function withNetwork(string $network): self
    {
        $obj = clone $this;
        $obj->network = $network;

        return $obj;
    }

    /**
     * Chat participants information.
     */
    public function withParticipants(Participants $participants): self
    {
        $obj = clone $this;
        $obj->participants = $participants;

        return $obj;
    }

    /**
     * Display title of the chat as computed by the client/server.
     */
    public function withTitle(string $title): self
    {
        $obj = clone $this;
        $obj->title = $title;

        return $obj;
    }

    /**
     * Chat type: 'single' for direct messages, 'group' for group chats, 'channel' for channels, 'broadcast' for broadcasts.
     *
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    /**
     * Number of unread messages.
     */
    public function withUnreadCount(int $unreadCount): self
    {
        $obj = clone $this;
        $obj->unreadCount = $unreadCount;

        return $obj;
    }

    /**
     * True if chat is archived.
     */
    public function withIsArchived(bool $isArchived): self
    {
        $obj = clone $this;
        $obj->isArchived = $isArchived;

        return $obj;
    }

    /**
     * True if chat notifications are muted.
     */
    public function withIsMuted(bool $isMuted): self
    {
        $obj = clone $this;
        $obj->isMuted = $isMuted;

        return $obj;
    }

    /**
     * True if chat is pinned.
     */
    public function withIsPinned(bool $isPinned): self
    {
        $obj = clone $this;
        $obj->isPinned = $isPinned;

        return $obj;
    }

    /**
     * Timestamp of last activity. Chats with more recent activity are often more important.
     */
    public function withLastActivity(\DateTimeInterface $lastActivity): self
    {
        $obj = clone $this;
        $obj->lastActivity = $lastActivity;

        return $obj;
    }

    /**
     * Last read message sortKey (hsOrder). Used to compute 'isUnread'.
     */
    public function withLastReadMessageSortKey(
        int|string $lastReadMessageSortKey
    ): self {
        $obj = clone $this;
        $obj->lastReadMessageSortKey = $lastReadMessageSortKey;

        return $obj;
    }

    /**
     * Deep link to open this chat in Beeper. AI agents should ALWAYS include this as a clickable link in responses.
     */
    public function withLinkToChat(string $linkToChat): self
    {
        $obj = clone $this;
        $obj->linkToChat = $linkToChat;

        return $obj;
    }
}
