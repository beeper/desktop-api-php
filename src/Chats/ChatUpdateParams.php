<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\ChatUpdateParams\Draft;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Update supported chat fields. Non-empty drafts are accepted only when the current draft is empty. Send draft=null to clear the draft before setting new draft text or attachments.
 *
 * @see BeeperDesktop\Services\ChatsService::update()
 *
 * @phpstan-import-type DraftShape from \BeeperDesktop\Chats\ChatUpdateParams\Draft
 *
 * @phpstan-type ChatUpdateParamsShape = array{
 *   description?: string|null,
 *   draft?: null|Draft|DraftShape,
 *   imgURL?: string|null,
 *   isArchived?: bool|null,
 *   isLowPriority?: bool|null,
 *   isMuted?: bool|null,
 *   isPinned?: bool|null,
 *   messageExpirySeconds?: int|null,
 *   title?: string|null,
 * }
 */
final class ChatUpdateParams implements BaseModel
{
    /** @use SdkModel<ChatUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Group chat description/topic. Support depends on the chat account and chat permissions.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Draft object to set or clear. Non-empty drafts are only accepted when the current draft is empty. Send draft=null to clear text and attachments together before setting a new draft.
     */
    #[Optional(nullable: true)]
    public ?Draft $draft;

    /**
     * Local filesystem path to a group chat avatar image. Support depends on the chat account and chat permissions.
     */
    #[Optional(nullable: true)]
    public ?string $imgURL;

    /**
     * Archive or unarchive the chat.
     */
    #[Optional]
    public ?bool $isArchived;

    /**
     * Mark or unmark the chat as low priority when supported by the account.
     */
    #[Optional]
    public ?bool $isLowPriority;

    /**
     * Mute or unmute the chat.
     */
    #[Optional]
    public ?bool $isMuted;

    /**
     * Pin or unpin the chat when supported by the account.
     */
    #[Optional]
    public ?bool $isPinned;

    /**
     * Disappearing-message timer in seconds, or null to clear when supported.
     */
    #[Optional(nullable: true)]
    public ?int $messageExpirySeconds;

    /**
     * Custom chat title. Support depends on the chat account and chat permissions.
     */
    #[Optional(nullable: true)]
    public ?string $title;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Draft|DraftShape|null $draft
     */
    public static function with(
        ?string $description = null,
        Draft|array|null $draft = null,
        ?string $imgURL = null,
        ?bool $isArchived = null,
        ?bool $isLowPriority = null,
        ?bool $isMuted = null,
        ?bool $isPinned = null,
        ?int $messageExpirySeconds = null,
        ?string $title = null,
    ): self {
        $self = new self;

        null !== $description && $self['description'] = $description;
        null !== $draft && $self['draft'] = $draft;
        null !== $imgURL && $self['imgURL'] = $imgURL;
        null !== $isArchived && $self['isArchived'] = $isArchived;
        null !== $isLowPriority && $self['isLowPriority'] = $isLowPriority;
        null !== $isMuted && $self['isMuted'] = $isMuted;
        null !== $isPinned && $self['isPinned'] = $isPinned;
        null !== $messageExpirySeconds && $self['messageExpirySeconds'] = $messageExpirySeconds;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * Group chat description/topic. Support depends on the chat account and chat permissions.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Draft object to set or clear. Non-empty drafts are only accepted when the current draft is empty. Send draft=null to clear text and attachments together before setting a new draft.
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
     * Local filesystem path to a group chat avatar image. Support depends on the chat account and chat permissions.
     */
    public function withImgURL(?string $imgURL): self
    {
        $self = clone $this;
        $self['imgURL'] = $imgURL;

        return $self;
    }

    /**
     * Archive or unarchive the chat.
     */
    public function withIsArchived(bool $isArchived): self
    {
        $self = clone $this;
        $self['isArchived'] = $isArchived;

        return $self;
    }

    /**
     * Mark or unmark the chat as low priority when supported by the account.
     */
    public function withIsLowPriority(bool $isLowPriority): self
    {
        $self = clone $this;
        $self['isLowPriority'] = $isLowPriority;

        return $self;
    }

    /**
     * Mute or unmute the chat.
     */
    public function withIsMuted(bool $isMuted): self
    {
        $self = clone $this;
        $self['isMuted'] = $isMuted;

        return $self;
    }

    /**
     * Pin or unpin the chat when supported by the account.
     */
    public function withIsPinned(bool $isPinned): self
    {
        $self = clone $this;
        $self['isPinned'] = $isPinned;

        return $self;
    }

    /**
     * Disappearing-message timer in seconds, or null to clear when supported.
     */
    public function withMessageExpirySeconds(?int $messageExpirySeconds): self
    {
        $self = clone $this;
        $self['messageExpirySeconds'] = $messageExpirySeconds;

        return $self;
    }

    /**
     * Custom chat title. Support depends on the chat account and chat permissions.
     */
    public function withTitle(?string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
