<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\Chat\Capabilities;
use BeeperDesktop\Chats\Chat\Draft;
use BeeperDesktop\Chats\Chat\Participants;
use BeeperDesktop\Chats\Chat\Reminder;
use BeeperDesktop\Chats\Chat\Snooze;
use BeeperDesktop\Chats\Chat\Type;
use BeeperDesktop\Chats\ChatNewResponse\Status;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ParticipantsShape from \BeeperDesktop\Chats\Chat\Participants
 * @phpstan-import-type CapabilitiesShape from \BeeperDesktop\Chats\Chat\Capabilities
 * @phpstan-import-type DraftShape from \BeeperDesktop\Chats\Chat\Draft
 * @phpstan-import-type ReminderShape from \BeeperDesktop\Chats\Chat\Reminder
 * @phpstan-import-type SnoozeShape from \BeeperDesktop\Chats\Chat\Snooze
 *
 * @phpstan-type ChatNewResponseShape = array{
 *   id: string,
 *   accountID: string,
 *   network: string,
 *   participants: Participants|ParticipantsShape,
 *   title: string,
 *   type: Type|value-of<Type>,
 *   unreadCount: int,
 *   capabilities?: null|Capabilities|CapabilitiesShape,
 *   description?: string|null,
 *   draft?: null|Draft|DraftShape,
 *   imgURL?: string|null,
 *   isArchived?: bool|null,
 *   isLowPriority?: bool|null,
 *   isMarkedUnread?: bool|null,
 *   isMuted?: bool|null,
 *   isPinned?: bool|null,
 *   isReadOnly?: bool|null,
 *   lastActivity?: \DateTimeInterface|null,
 *   lastReadMessageSortKey?: string|null,
 *   localChatID?: string|null,
 *   messageExpirySeconds?: int|null,
 *   reminder?: null|Reminder|ReminderShape,
 *   snooze?: null|Snooze|SnoozeShape,
 *   unreadMentionsCount?: int|null,
 *   chatID: string,
 *   status?: null|Status|value-of<Status>,
 * }
 */
final class ChatNewResponse implements BaseModel
{
    /** @use SdkModel<ChatNewResponseShape> */
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
     * Display-only human-readable account/network name.
     */
    #[Required]
    public string $network;

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
     * Chat capabilities reported by the platform.
     */
    #[Optional]
    public ?Capabilities $capabilities;

    /**
     * Group chat description/topic when available.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Current draft object for this chat, or null when no draft is set.
     */
    #[Optional(nullable: true)]
    public ?Draft $draft;

    /**
     * Local filesystem path to the chat avatar image when available.
     */
    #[Optional(nullable: true)]
    public ?string $imgURL;

    /**
     * True if chat is archived.
     */
    #[Optional]
    public ?bool $isArchived;

    /**
     * True if chat is marked low priority.
     */
    #[Optional]
    public ?bool $isLowPriority;

    /**
     * True if the chat was explicitly marked unread by the authenticated user.
     */
    #[Optional]
    public ?bool $isMarkedUnread;

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
     * True if messages cannot be sent in this chat.
     */
    #[Optional]
    public ?bool $isReadOnly;

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

    /**
     * Disappearing-message timer in seconds when available.
     */
    #[Optional(nullable: true)]
    public ?int $messageExpirySeconds;

    /**
     * Current reminder for this chat, or null when no reminder is set.
     */
    #[Optional(nullable: true)]
    public ?Reminder $reminder;

    /**
     * Current snooze state for this chat, or null when no snooze is set.
     */
    #[Optional(nullable: true)]
    public ?Snooze $snooze;

    /**
     * Number of unread messages that mention the authenticated user or @room.
     */
    #[Optional]
    public ?int $unreadMentionsCount;

    /**
     * @deprecated
     *
     * DEPRECATED - use id instead. Compatibility alias for older clients.
     */
    #[Required]
    public string $chatID;

    /**
     * @deprecated
     *
     * DEPRECATED - legacy start-chat status for older clients. New clients should inspect the returned Chat instead.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new ChatNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatNewResponse::with(
     *   id: ...,
     *   accountID: ...,
     *   network: ...,
     *   participants: ...,
     *   title: ...,
     *   type: ...,
     *   unreadCount: ...,
     *   chatID: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatNewResponse)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withNetwork(...)
     *   ->withParticipants(...)
     *   ->withTitle(...)
     *   ->withType(...)
     *   ->withUnreadCount(...)
     *   ->withChatID(...)
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
     * @param Capabilities|CapabilitiesShape|null $capabilities
     * @param Draft|DraftShape|null $draft
     * @param Reminder|ReminderShape|null $reminder
     * @param Snooze|SnoozeShape|null $snooze
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $id,
        string $accountID,
        string $network,
        Participants|array $participants,
        string $title,
        Type|string $type,
        int $unreadCount,
        string $chatID,
        Capabilities|array|null $capabilities = null,
        ?string $description = null,
        Draft|array|null $draft = null,
        ?string $imgURL = null,
        ?bool $isArchived = null,
        ?bool $isLowPriority = null,
        ?bool $isMarkedUnread = null,
        ?bool $isMuted = null,
        ?bool $isPinned = null,
        ?bool $isReadOnly = null,
        ?\DateTimeInterface $lastActivity = null,
        ?string $lastReadMessageSortKey = null,
        ?string $localChatID = null,
        ?int $messageExpirySeconds = null,
        Reminder|array|null $reminder = null,
        Snooze|array|null $snooze = null,
        ?int $unreadMentionsCount = null,
        Status|string|null $status = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['network'] = $network;
        $self['participants'] = $participants;
        $self['title'] = $title;
        $self['type'] = $type;
        $self['unreadCount'] = $unreadCount;
        $self['chatID'] = $chatID;

        null !== $capabilities && $self['capabilities'] = $capabilities;
        null !== $description && $self['description'] = $description;
        null !== $draft && $self['draft'] = $draft;
        null !== $imgURL && $self['imgURL'] = $imgURL;
        null !== $isArchived && $self['isArchived'] = $isArchived;
        null !== $isLowPriority && $self['isLowPriority'] = $isLowPriority;
        null !== $isMarkedUnread && $self['isMarkedUnread'] = $isMarkedUnread;
        null !== $isMuted && $self['isMuted'] = $isMuted;
        null !== $isPinned && $self['isPinned'] = $isPinned;
        null !== $isReadOnly && $self['isReadOnly'] = $isReadOnly;
        null !== $lastActivity && $self['lastActivity'] = $lastActivity;
        null !== $lastReadMessageSortKey && $self['lastReadMessageSortKey'] = $lastReadMessageSortKey;
        null !== $localChatID && $self['localChatID'] = $localChatID;
        null !== $messageExpirySeconds && $self['messageExpirySeconds'] = $messageExpirySeconds;
        null !== $reminder && $self['reminder'] = $reminder;
        null !== $snooze && $self['snooze'] = $snooze;
        null !== $unreadMentionsCount && $self['unreadMentionsCount'] = $unreadMentionsCount;
        null !== $status && $self['status'] = $status;

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
     * Display-only human-readable account/network name.
     */
    public function withNetwork(string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

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
     * Chat capabilities reported by the platform.
     *
     * @param Capabilities|CapabilitiesShape $capabilities
     */
    public function withCapabilities(Capabilities|array $capabilities): self
    {
        $self = clone $this;
        $self['capabilities'] = $capabilities;

        return $self;
    }

    /**
     * Group chat description/topic when available.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Current draft object for this chat, or null when no draft is set.
     *
     * @param Draft|DraftShape|null $draft
     */
    public function withDraft(Draft|array|null $draft): self
    {
        $self = clone $this;
        $self['draft'] = $draft;

        return $self;
    }

    /**
     * Local filesystem path to the chat avatar image when available.
     */
    public function withImgURL(?string $imgURL): self
    {
        $self = clone $this;
        $self['imgURL'] = $imgURL;

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
     * True if chat is marked low priority.
     */
    public function withIsLowPriority(bool $isLowPriority): self
    {
        $self = clone $this;
        $self['isLowPriority'] = $isLowPriority;

        return $self;
    }

    /**
     * True if the chat was explicitly marked unread by the authenticated user.
     */
    public function withIsMarkedUnread(bool $isMarkedUnread): self
    {
        $self = clone $this;
        $self['isMarkedUnread'] = $isMarkedUnread;

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
     * True if messages cannot be sent in this chat.
     */
    public function withIsReadOnly(bool $isReadOnly): self
    {
        $self = clone $this;
        $self['isReadOnly'] = $isReadOnly;

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
     * Disappearing-message timer in seconds when available.
     */
    public function withMessageExpirySeconds(?int $messageExpirySeconds): self
    {
        $self = clone $this;
        $self['messageExpirySeconds'] = $messageExpirySeconds;

        return $self;
    }

    /**
     * Current reminder for this chat, or null when no reminder is set.
     *
     * @param Reminder|ReminderShape|null $reminder
     */
    public function withReminder(Reminder|array|null $reminder): self
    {
        $self = clone $this;
        $self['reminder'] = $reminder;

        return $self;
    }

    /**
     * Current snooze state for this chat, or null when no snooze is set.
     *
     * @param Snooze|SnoozeShape|null $snooze
     */
    public function withSnooze(Snooze|array|null $snooze): self
    {
        $self = clone $this;
        $self['snooze'] = $snooze;

        return $self;
    }

    /**
     * Number of unread messages that mention the authenticated user or @room.
     */
    public function withUnreadMentionsCount(int $unreadMentionsCount): self
    {
        $self = clone $this;
        $self['unreadMentionsCount'] = $unreadMentionsCount;

        return $self;
    }

    /**
     * DEPRECATED - use id instead. Compatibility alias for older clients.
     */
    public function withChatID(string $chatID): self
    {
        $self = clone $this;
        $self['chatID'] = $chatID;

        return $self;
    }

    /**
     * DEPRECATED - legacy start-chat status for older clients. New clients should inspect the returned Chat instead.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
