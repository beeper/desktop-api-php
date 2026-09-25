<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Current draft object for this chat, or null when no draft is set.
 *
 * @phpstan-import-type DraftAttachmentShape from \BeeperDesktop\DraftAttachment
 *
 * @phpstan-type ChatDraftShape = array{
 *   text: string,
 *   attachments?: array<string,DraftAttachment|DraftAttachmentShape>|null,
 * }
 */
final class ChatDraft implements BaseModel
{
    /** @use SdkModel<ChatDraftShape> */
    use SdkModel;

    /**
     * Rich-text draft body as returned by Beeper.
     */
    #[Required]
    public string $text;

    /**
     * Draft attachments keyed by attachment ID.
     *
     * @var array<string,DraftAttachment>|null $attachments
     */
    #[Optional(map: DraftAttachment::class)]
    public ?array $attachments;

    /**
     * `new ChatDraft()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatDraft::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatDraft)->withText(...)
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
     * @param array<string,DraftAttachment|DraftAttachmentShape>|null $attachments
     */
    public static function with(string $text, ?array $attachments = null): self
    {
        $self = new self;

        $self['text'] = $text;

        null !== $attachments && $self['attachments'] = $attachments;

        return $self;
    }

    /**
     * Rich-text draft body as returned by Beeper.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Draft attachments keyed by attachment ID.
     *
     * @param array<string,DraftAttachment|DraftAttachmentShape> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }
}
