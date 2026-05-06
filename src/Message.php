<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Message\Link;
use BeeperDesktop\Message\Seen;
use BeeperDesktop\Message\SendStatus;
use BeeperDesktop\Message\Type;

/**
 * @phpstan-import-type SeenVariants from \BeeperDesktop\Message\Seen
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Attachment
 * @phpstan-import-type LinkShape from \BeeperDesktop\Message\Link
 * @phpstan-import-type ReactionShape from \BeeperDesktop\Reaction
 * @phpstan-import-type SeenShape from \BeeperDesktop\Message\Seen
 * @phpstan-import-type SendStatusShape from \BeeperDesktop\Message\SendStatus
 *
 * @phpstan-type MessageShape = array{
 *   id: string,
 *   accountID: string,
 *   chatID: string,
 *   senderID: string,
 *   sortKey: string,
 *   timestamp: \DateTimeInterface,
 *   attachments?: list<Attachment|AttachmentShape>|null,
 *   editedTimestamp?: \DateTimeInterface|null,
 *   isDeleted?: bool|null,
 *   isHidden?: bool|null,
 *   isSender?: bool|null,
 *   isUnread?: bool|null,
 *   linkedMessageID?: string|null,
 *   links?: list<Link|LinkShape>|null,
 *   mentions?: list<string>|null,
 *   reactions?: list<Reaction|ReactionShape>|null,
 *   seen?: SeenShape|null,
 *   senderName?: string|null,
 *   sendStatus?: null|SendStatus|SendStatusShape,
 *   text?: string|null,
 *   type?: null|Type|value-of<Type>,
 * }
 */
final class Message implements BaseModel
{
    /** @use SdkModel<MessageShape> */
    use SdkModel;

    /**
     * Message ID.
     */
    #[Required]
    public string $id;

    /**
     * Beeper account ID the message belongs to.
     */
    #[Required]
    public string $accountID;

    /**
     * Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     */
    #[Required]
    public string $chatID;

    /**
     * Matrix-style fully-qualified sender user ID, usually including a bridge prefix and homeserver.
     */
    #[Required]
    public string $senderID;

    /**
     * A unique, sortable key used to sort messages.
     */
    #[Required]
    public string $sortKey;

    /**
     * Message timestamp.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * Attachments included with this message, if any.
     *
     * @var list<Attachment>|null $attachments
     */
    #[Optional(list: Attachment::class)]
    public ?array $attachments;

    /**
     * Timestamp when the message was edited, if known.
     */
    #[Optional]
    public ?\DateTimeInterface $editedTimestamp;

    /**
     * True if the message has been deleted.
     */
    #[Optional]
    public ?bool $isDeleted;

    /**
     * True if the message is hidden from normal display.
     */
    #[Optional]
    public ?bool $isHidden;

    /**
     * True if the authenticated user sent the message.
     */
    #[Optional]
    public ?bool $isSender;

    /**
     * True if the message is unread for the authenticated user. May be omitted.
     */
    #[Optional]
    public ?bool $isUnread;

    /**
     * ID of the message this is a reply to, if any.
     */
    #[Optional]
    public ?string $linkedMessageID;

    /**
     * Link previews included with this message, if any.
     *
     * @var list<Link>|null $links
     */
    #[Optional(list: Link::class)]
    public ?array $links;

    /**
     * Mentioned user IDs, @room, or null for legacy messages that require text scanning.
     *
     * @var list<string>|null $mentions
     */
    #[Optional(list: 'string', nullable: true)]
    public ?array $mentions;

    /**
     * Reactions to the message, if any.
     *
     * @var list<Reaction>|null $reactions
     */
    #[Optional(list: Reaction::class)]
    public ?array $reactions;

    /**
     * Read receipt state for this message, when available.
     *
     * @var SeenVariants|null $seen
     */
    #[Optional(union: Seen::class)]
    public bool|\DateTimeInterface|array|null $seen;

    /**
     * Resolved sender display name (impersonator/full name/username/participant name).
     */
    #[Optional]
    public ?string $senderName;

    /**
     * Message send status for this message, when reported by the bridge.
     */
    #[Optional]
    public ?SendStatus $sendStatus;

    /**
     * Matrix HTML body if present.
     */
    #[Optional]
    public ?string $text;

    /**
     * Message content type. Useful for distinguishing reactions, media messages, and state events from regular text messages.
     *
     * @var value-of<Type>|null $type
     */
    #[Optional(enum: Type::class)]
    public ?string $type;

    /**
     * `new Message()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Message::with(
     *   id: ...,
     *   accountID: ...,
     *   chatID: ...,
     *   senderID: ...,
     *   sortKey: ...,
     *   timestamp: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Message)
     *   ->withID(...)
     *   ->withAccountID(...)
     *   ->withChatID(...)
     *   ->withSenderID(...)
     *   ->withSortKey(...)
     *   ->withTimestamp(...)
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
     * @param list<Attachment|AttachmentShape>|null $attachments
     * @param list<Link|LinkShape>|null $links
     * @param list<string>|null $mentions
     * @param list<Reaction|ReactionShape>|null $reactions
     * @param SeenShape|null $seen
     * @param SendStatus|SendStatusShape|null $sendStatus
     * @param Type|value-of<Type>|null $type
     */
    public static function with(
        string $id,
        string $accountID,
        string $chatID,
        string $senderID,
        string $sortKey,
        \DateTimeInterface $timestamp,
        ?array $attachments = null,
        ?\DateTimeInterface $editedTimestamp = null,
        ?bool $isDeleted = null,
        ?bool $isHidden = null,
        ?bool $isSender = null,
        ?bool $isUnread = null,
        ?string $linkedMessageID = null,
        ?array $links = null,
        ?array $mentions = null,
        ?array $reactions = null,
        bool|\DateTimeInterface|array|null $seen = null,
        ?string $senderName = null,
        SendStatus|array|null $sendStatus = null,
        ?string $text = null,
        Type|string|null $type = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accountID'] = $accountID;
        $self['chatID'] = $chatID;
        $self['senderID'] = $senderID;
        $self['sortKey'] = $sortKey;
        $self['timestamp'] = $timestamp;

        null !== $attachments && $self['attachments'] = $attachments;
        null !== $editedTimestamp && $self['editedTimestamp'] = $editedTimestamp;
        null !== $isDeleted && $self['isDeleted'] = $isDeleted;
        null !== $isHidden && $self['isHidden'] = $isHidden;
        null !== $isSender && $self['isSender'] = $isSender;
        null !== $isUnread && $self['isUnread'] = $isUnread;
        null !== $linkedMessageID && $self['linkedMessageID'] = $linkedMessageID;
        null !== $links && $self['links'] = $links;
        null !== $mentions && $self['mentions'] = $mentions;
        null !== $reactions && $self['reactions'] = $reactions;
        null !== $seen && $self['seen'] = $seen;
        null !== $senderName && $self['senderName'] = $senderName;
        null !== $sendStatus && $self['sendStatus'] = $sendStatus;
        null !== $text && $self['text'] = $text;
        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * Message ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Beeper account ID the message belongs to.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Chat ID. Input routes also accept the local chat ID from this Beeper Desktop installation when available.
     */
    public function withChatID(string $chatID): self
    {
        $self = clone $this;
        $self['chatID'] = $chatID;

        return $self;
    }

    /**
     * Matrix-style fully-qualified sender user ID, usually including a bridge prefix and homeserver.
     */
    public function withSenderID(string $senderID): self
    {
        $self = clone $this;
        $self['senderID'] = $senderID;

        return $self;
    }

    /**
     * A unique, sortable key used to sort messages.
     */
    public function withSortKey(string $sortKey): self
    {
        $self = clone $this;
        $self['sortKey'] = $sortKey;

        return $self;
    }

    /**
     * Message timestamp.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * Attachments included with this message, if any.
     *
     * @param list<Attachment|AttachmentShape> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }

    /**
     * Timestamp when the message was edited, if known.
     */
    public function withEditedTimestamp(
        \DateTimeInterface $editedTimestamp
    ): self {
        $self = clone $this;
        $self['editedTimestamp'] = $editedTimestamp;

        return $self;
    }

    /**
     * True if the message has been deleted.
     */
    public function withIsDeleted(bool $isDeleted): self
    {
        $self = clone $this;
        $self['isDeleted'] = $isDeleted;

        return $self;
    }

    /**
     * True if the message is hidden from normal display.
     */
    public function withIsHidden(bool $isHidden): self
    {
        $self = clone $this;
        $self['isHidden'] = $isHidden;

        return $self;
    }

    /**
     * True if the authenticated user sent the message.
     */
    public function withIsSender(bool $isSender): self
    {
        $self = clone $this;
        $self['isSender'] = $isSender;

        return $self;
    }

    /**
     * True if the message is unread for the authenticated user. May be omitted.
     */
    public function withIsUnread(bool $isUnread): self
    {
        $self = clone $this;
        $self['isUnread'] = $isUnread;

        return $self;
    }

    /**
     * ID of the message this is a reply to, if any.
     */
    public function withLinkedMessageID(string $linkedMessageID): self
    {
        $self = clone $this;
        $self['linkedMessageID'] = $linkedMessageID;

        return $self;
    }

    /**
     * Link previews included with this message, if any.
     *
     * @param list<Link|LinkShape> $links
     */
    public function withLinks(array $links): self
    {
        $self = clone $this;
        $self['links'] = $links;

        return $self;
    }

    /**
     * Mentioned user IDs, @room, or null for legacy messages that require text scanning.
     *
     * @param list<string>|null $mentions
     */
    public function withMentions(?array $mentions): self
    {
        $self = clone $this;
        $self['mentions'] = $mentions;

        return $self;
    }

    /**
     * Reactions to the message, if any.
     *
     * @param list<Reaction|ReactionShape> $reactions
     */
    public function withReactions(array $reactions): self
    {
        $self = clone $this;
        $self['reactions'] = $reactions;

        return $self;
    }

    /**
     * Read receipt state for this message, when available.
     *
     * @param SeenShape $seen
     */
    public function withSeen(bool|\DateTimeInterface|array $seen): self
    {
        $self = clone $this;
        $self['seen'] = $seen;

        return $self;
    }

    /**
     * Resolved sender display name (impersonator/full name/username/participant name).
     */
    public function withSenderName(string $senderName): self
    {
        $self = clone $this;
        $self['senderName'] = $senderName;

        return $self;
    }

    /**
     * Message send status for this message, when reported by the bridge.
     *
     * @param SendStatus|SendStatusShape $sendStatus
     */
    public function withSendStatus(SendStatus|array $sendStatus): self
    {
        $self = clone $this;
        $self['sendStatus'] = $sendStatus;

        return $self;
    }

    /**
     * Matrix HTML body if present.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Message content type. Useful for distinguishing reactions, media messages, and state events from regular text messages.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
