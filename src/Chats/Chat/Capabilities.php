<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat;

use BeeperDesktop\Chats\Chat\Capabilities\Attachment;
use BeeperDesktop\Chats\Chat\Capabilities\Delete;
use BeeperDesktop\Chats\Chat\Capabilities\DisappearingTimer;
use BeeperDesktop\Chats\Chat\Capabilities\Edit;
use BeeperDesktop\Chats\Chat\Capabilities\Formatting;
use BeeperDesktop\Chats\Chat\Capabilities\LocationMessage;
use BeeperDesktop\Chats\Chat\Capabilities\MessageRequest;
use BeeperDesktop\Chats\Chat\Capabilities\ParticipantActions;
use BeeperDesktop\Chats\Chat\Capabilities\Poll;
use BeeperDesktop\Chats\Chat\Capabilities\Reaction;
use BeeperDesktop\Chats\Chat\Capabilities\Reply;
use BeeperDesktop\Chats\Chat\Capabilities\State;
use BeeperDesktop\Chats\Chat\Capabilities\Thread;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Chat capabilities reported by the platform.
 *
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Chats\Chat\Capabilities\Attachment
 * @phpstan-import-type DisappearingTimerShape from \BeeperDesktop\Chats\Chat\Capabilities\DisappearingTimer
 * @phpstan-import-type MessageRequestShape from \BeeperDesktop\Chats\Chat\Capabilities\MessageRequest
 * @phpstan-import-type ParticipantActionsShape from \BeeperDesktop\Chats\Chat\Capabilities\ParticipantActions
 * @phpstan-import-type StateShape from \BeeperDesktop\Chats\Chat\Capabilities\State
 *
 * @phpstan-type CapabilitiesShape = array{
 *   allowedReactions?: list<string>|null,
 *   archive?: bool|null,
 *   attachments?: array<string,Attachment|AttachmentShape>|null,
 *   customEmojiReactions?: bool|null,
 *   delete?: null|Delete|value-of<Delete>,
 *   deleteChat?: bool|null,
 *   deleteChatForEveryone?: bool|null,
 *   deleteForMe?: bool|null,
 *   deleteMaxAge?: int|null,
 *   disappearingTimer?: null|DisappearingTimer|DisappearingTimerShape,
 *   edit?: null|Edit|value-of<Edit>,
 *   editMaxAge?: int|null,
 *   editMaxCount?: int|null,
 *   formatting?: array<string,Formatting|value-of<Formatting>>|null,
 *   locationMessage?: null|LocationMessage|value-of<LocationMessage>,
 *   markAsUnread?: bool|null,
 *   maxTextLength?: int|null,
 *   messageRequest?: null|MessageRequest|MessageRequestShape,
 *   participantActions?: null|ParticipantActions|ParticipantActionsShape,
 *   poll?: null|Poll|value-of<Poll>,
 *   reaction?: null|Reaction|value-of<Reaction>,
 *   reactionCount?: int|null,
 *   readReceipts?: bool|null,
 *   reply?: null|Reply|value-of<Reply>,
 *   state?: null|State|StateShape,
 *   thread?: null|Thread|value-of<Thread>,
 *   typingNotifications?: bool|null,
 * }
 */
final class Capabilities implements BaseModel
{
    /** @use SdkModel<CapabilitiesShape> */
    use SdkModel;

    /**
     * Allowed Unicode reactions. Omitted means all emoji reactions are allowed.
     *
     * @var list<string>|null $allowedReactions
     */
    #[Optional(list: 'string')]
    public ?array $allowedReactions;

    /**
     * True if archive/unarchive is supported.
     */
    #[Optional]
    public ?bool $archive;

    /**
     * Supported attachment message types and their per-type constraints, keyed by Matrix msgtype or pseudo-msgtype (for example m.image, m.video, org.matrix.msc3245.voice). Missing message types should be treated as rejected.
     *
     * @var array<string,Attachment>|null $attachments
     */
    #[Optional(map: Attachment::class)]
    public ?array $attachments;

    /**
     * True if custom emoji reactions are supported.
     */
    #[Optional]
    public ?bool $customEmojiReactions;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Delete>|null $delete
     */
    #[Optional(enum: Delete::class)]
    public ?int $delete;

    /**
     * True if deleting chats for the authenticated user is supported.
     */
    #[Optional]
    public ?bool $deleteChat;

    /**
     * True if deleting chats for everyone is supported.
     */
    #[Optional]
    public ?bool $deleteChatForEveryone;

    /**
     * True if deleting messages only for the authenticated user is supported.
     */
    #[Optional]
    public ?bool $deleteForMe;

    /**
     * Maximum message age for delete-for-everyone, in seconds.
     */
    #[Optional]
    public ?int $deleteMaxAge;

    /**
     * Disappearing-message timer capabilities.
     */
    #[Optional]
    public ?DisappearingTimer $disappearingTimer;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Edit>|null $edit
     */
    #[Optional(enum: Edit::class)]
    public ?int $edit;

    /**
     * Maximum message age for edits, in seconds.
     */
    #[Optional]
    public ?int $editMaxAge;

    /**
     * Maximum number of edits allowed for one message.
     */
    #[Optional]
    public ?int $editMaxCount;

    /**
     * Supported rich-text formatting features keyed by feature name (for example bold, inline_code, code_block.syntax_highlighting). Omitted means no formatting support is advertised.
     *
     * @var array<string,value-of<Formatting>>|null $formatting
     */
    #[Optional(map: Formatting::class)]
    public ?array $formatting;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<LocationMessage>|null $locationMessage
     */
    #[Optional(enum: LocationMessage::class)]
    public ?int $locationMessage;

    /**
     * True if marking chats unread is supported.
     */
    #[Optional]
    public ?bool $markAsUnread;

    /**
     * Maximum length of normal text messages.
     */
    #[Optional]
    public ?int $maxTextLength;

    /**
     * Message request capabilities.
     */
    #[Optional]
    public ?MessageRequest $messageRequest;

    /**
     * Participant management capabilities.
     */
    #[Optional]
    public ?ParticipantActions $participantActions;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Poll>|null $poll
     */
    #[Optional(enum: Poll::class)]
    public ?int $poll;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Reaction>|null $reaction
     */
    #[Optional(enum: Reaction::class)]
    public ?int $reaction;

    /**
     * Maximum number of reactions allowed on a single message.
     */
    #[Optional]
    public ?int $reactionCount;

    /**
     * True if read receipts are supported.
     */
    #[Optional]
    public ?bool $readReceipts;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Reply>|null $reply
     */
    #[Optional(enum: Reply::class)]
    public ?int $reply;

    /**
     * Chat state update capabilities.
     */
    #[Optional]
    public ?State $state;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<Thread>|null $thread
     */
    #[Optional(enum: Thread::class)]
    public ?int $thread;

    /**
     * True if typing notifications are supported.
     */
    #[Optional]
    public ?bool $typingNotifications;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $allowedReactions
     * @param array<string,Attachment|AttachmentShape>|null $attachments
     * @param Delete|value-of<Delete>|null $delete
     * @param DisappearingTimer|DisappearingTimerShape|null $disappearingTimer
     * @param Edit|value-of<Edit>|null $edit
     * @param array<string,Formatting|value-of<Formatting>>|null $formatting
     * @param LocationMessage|value-of<LocationMessage>|null $locationMessage
     * @param MessageRequest|MessageRequestShape|null $messageRequest
     * @param ParticipantActions|ParticipantActionsShape|null $participantActions
     * @param Poll|value-of<Poll>|null $poll
     * @param Reaction|value-of<Reaction>|null $reaction
     * @param Reply|value-of<Reply>|null $reply
     * @param State|StateShape|null $state
     * @param Thread|value-of<Thread>|null $thread
     */
    public static function with(
        ?array $allowedReactions = null,
        ?bool $archive = null,
        ?array $attachments = null,
        ?bool $customEmojiReactions = null,
        Delete|int|null $delete = null,
        ?bool $deleteChat = null,
        ?bool $deleteChatForEveryone = null,
        ?bool $deleteForMe = null,
        ?int $deleteMaxAge = null,
        DisappearingTimer|array|null $disappearingTimer = null,
        Edit|int|null $edit = null,
        ?int $editMaxAge = null,
        ?int $editMaxCount = null,
        ?array $formatting = null,
        LocationMessage|int|null $locationMessage = null,
        ?bool $markAsUnread = null,
        ?int $maxTextLength = null,
        MessageRequest|array|null $messageRequest = null,
        ParticipantActions|array|null $participantActions = null,
        Poll|int|null $poll = null,
        Reaction|int|null $reaction = null,
        ?int $reactionCount = null,
        ?bool $readReceipts = null,
        Reply|int|null $reply = null,
        State|array|null $state = null,
        Thread|int|null $thread = null,
        ?bool $typingNotifications = null,
    ): self {
        $self = new self;

        null !== $allowedReactions && $self['allowedReactions'] = $allowedReactions;
        null !== $archive && $self['archive'] = $archive;
        null !== $attachments && $self['attachments'] = $attachments;
        null !== $customEmojiReactions && $self['customEmojiReactions'] = $customEmojiReactions;
        null !== $delete && $self['delete'] = $delete;
        null !== $deleteChat && $self['deleteChat'] = $deleteChat;
        null !== $deleteChatForEveryone && $self['deleteChatForEveryone'] = $deleteChatForEveryone;
        null !== $deleteForMe && $self['deleteForMe'] = $deleteForMe;
        null !== $deleteMaxAge && $self['deleteMaxAge'] = $deleteMaxAge;
        null !== $disappearingTimer && $self['disappearingTimer'] = $disappearingTimer;
        null !== $edit && $self['edit'] = $edit;
        null !== $editMaxAge && $self['editMaxAge'] = $editMaxAge;
        null !== $editMaxCount && $self['editMaxCount'] = $editMaxCount;
        null !== $formatting && $self['formatting'] = $formatting;
        null !== $locationMessage && $self['locationMessage'] = $locationMessage;
        null !== $markAsUnread && $self['markAsUnread'] = $markAsUnread;
        null !== $maxTextLength && $self['maxTextLength'] = $maxTextLength;
        null !== $messageRequest && $self['messageRequest'] = $messageRequest;
        null !== $participantActions && $self['participantActions'] = $participantActions;
        null !== $poll && $self['poll'] = $poll;
        null !== $reaction && $self['reaction'] = $reaction;
        null !== $reactionCount && $self['reactionCount'] = $reactionCount;
        null !== $readReceipts && $self['readReceipts'] = $readReceipts;
        null !== $reply && $self['reply'] = $reply;
        null !== $state && $self['state'] = $state;
        null !== $thread && $self['thread'] = $thread;
        null !== $typingNotifications && $self['typingNotifications'] = $typingNotifications;

        return $self;
    }

    /**
     * Allowed Unicode reactions. Omitted means all emoji reactions are allowed.
     *
     * @param list<string> $allowedReactions
     */
    public function withAllowedReactions(array $allowedReactions): self
    {
        $self = clone $this;
        $self['allowedReactions'] = $allowedReactions;

        return $self;
    }

    /**
     * True if archive/unarchive is supported.
     */
    public function withArchive(bool $archive): self
    {
        $self = clone $this;
        $self['archive'] = $archive;

        return $self;
    }

    /**
     * Supported attachment message types and their per-type constraints, keyed by Matrix msgtype or pseudo-msgtype (for example m.image, m.video, org.matrix.msc3245.voice). Missing message types should be treated as rejected.
     *
     * @param array<string,Attachment|AttachmentShape> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }

    /**
     * True if custom emoji reactions are supported.
     */
    public function withCustomEmojiReactions(bool $customEmojiReactions): self
    {
        $self = clone $this;
        $self['customEmojiReactions'] = $customEmojiReactions;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Delete|value-of<Delete> $delete
     */
    public function withDelete(Delete|int $delete): self
    {
        $self = clone $this;
        $self['delete'] = $delete;

        return $self;
    }

    /**
     * True if deleting chats for the authenticated user is supported.
     */
    public function withDeleteChat(bool $deleteChat): self
    {
        $self = clone $this;
        $self['deleteChat'] = $deleteChat;

        return $self;
    }

    /**
     * True if deleting chats for everyone is supported.
     */
    public function withDeleteChatForEveryone(bool $deleteChatForEveryone): self
    {
        $self = clone $this;
        $self['deleteChatForEveryone'] = $deleteChatForEveryone;

        return $self;
    }

    /**
     * True if deleting messages only for the authenticated user is supported.
     */
    public function withDeleteForMe(bool $deleteForMe): self
    {
        $self = clone $this;
        $self['deleteForMe'] = $deleteForMe;

        return $self;
    }

    /**
     * Maximum message age for delete-for-everyone, in seconds.
     */
    public function withDeleteMaxAge(int $deleteMaxAge): self
    {
        $self = clone $this;
        $self['deleteMaxAge'] = $deleteMaxAge;

        return $self;
    }

    /**
     * Disappearing-message timer capabilities.
     *
     * @param DisappearingTimer|DisappearingTimerShape $disappearingTimer
     */
    public function withDisappearingTimer(
        DisappearingTimer|array $disappearingTimer
    ): self {
        $self = clone $this;
        $self['disappearingTimer'] = $disappearingTimer;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Edit|value-of<Edit> $edit
     */
    public function withEdit(Edit|int $edit): self
    {
        $self = clone $this;
        $self['edit'] = $edit;

        return $self;
    }

    /**
     * Maximum message age for edits, in seconds.
     */
    public function withEditMaxAge(int $editMaxAge): self
    {
        $self = clone $this;
        $self['editMaxAge'] = $editMaxAge;

        return $self;
    }

    /**
     * Maximum number of edits allowed for one message.
     */
    public function withEditMaxCount(int $editMaxCount): self
    {
        $self = clone $this;
        $self['editMaxCount'] = $editMaxCount;

        return $self;
    }

    /**
     * Supported rich-text formatting features keyed by feature name (for example bold, inline_code, code_block.syntax_highlighting). Omitted means no formatting support is advertised.
     *
     * @param array<string,Formatting|value-of<Formatting>> $formatting
     */
    public function withFormatting(array $formatting): self
    {
        $self = clone $this;
        $self['formatting'] = $formatting;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param LocationMessage|value-of<LocationMessage> $locationMessage
     */
    public function withLocationMessage(
        LocationMessage|int $locationMessage
    ): self {
        $self = clone $this;
        $self['locationMessage'] = $locationMessage;

        return $self;
    }

    /**
     * True if marking chats unread is supported.
     */
    public function withMarkAsUnread(bool $markAsUnread): self
    {
        $self = clone $this;
        $self['markAsUnread'] = $markAsUnread;

        return $self;
    }

    /**
     * Maximum length of normal text messages.
     */
    public function withMaxTextLength(int $maxTextLength): self
    {
        $self = clone $this;
        $self['maxTextLength'] = $maxTextLength;

        return $self;
    }

    /**
     * Message request capabilities.
     *
     * @param MessageRequest|MessageRequestShape $messageRequest
     */
    public function withMessageRequest(
        MessageRequest|array $messageRequest
    ): self {
        $self = clone $this;
        $self['messageRequest'] = $messageRequest;

        return $self;
    }

    /**
     * Participant management capabilities.
     *
     * @param ParticipantActions|ParticipantActionsShape $participantActions
     */
    public function withParticipantActions(
        ParticipantActions|array $participantActions
    ): self {
        $self = clone $this;
        $self['participantActions'] = $participantActions;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Poll|value-of<Poll> $poll
     */
    public function withPoll(Poll|int $poll): self
    {
        $self = clone $this;
        $self['poll'] = $poll;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Reaction|value-of<Reaction> $reaction
     */
    public function withReaction(Reaction|int $reaction): self
    {
        $self = clone $this;
        $self['reaction'] = $reaction;

        return $self;
    }

    /**
     * Maximum number of reactions allowed on a single message.
     */
    public function withReactionCount(int $reactionCount): self
    {
        $self = clone $this;
        $self['reactionCount'] = $reactionCount;

        return $self;
    }

    /**
     * True if read receipts are supported.
     */
    public function withReadReceipts(bool $readReceipts): self
    {
        $self = clone $this;
        $self['readReceipts'] = $readReceipts;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Reply|value-of<Reply> $reply
     */
    public function withReply(Reply|int $reply): self
    {
        $self = clone $this;
        $self['reply'] = $reply;

        return $self;
    }

    /**
     * Chat state update capabilities.
     *
     * @param State|StateShape $state
     */
    public function withState(State|array $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param Thread|value-of<Thread> $thread
     */
    public function withThread(Thread|int $thread): self
    {
        $self = clone $this;
        $self['thread'] = $thread;

        return $self;
    }

    /**
     * True if typing notifications are supported.
     */
    public function withTypingNotifications(bool $typingNotifications): self
    {
        $self = clone $this;
        $self['typingNotifications'] = $typingNotifications;

        return $self;
    }
}
