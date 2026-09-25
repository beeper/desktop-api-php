<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatUpdateParams;

use BeeperDesktop\Chats\ChatUpdateParams\Draft\Attachment;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Draft object to set or clear. Non-empty drafts are only accepted when the current draft is empty. Send draft=null to clear text and attachments together before setting a new draft.
 *
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Chats\ChatUpdateParams\Draft\Attachment
 *
 * @phpstan-type DraftShape = array{
 *   text: string, attachments?: array<string,Attachment|AttachmentShape>|null
 * }
 */
final class Draft implements BaseModel
{
    /** @use SdkModel<DraftShape> */
    use SdkModel;

    /**
     * Draft text. Plain text and Markdown are converted to Beeper rich text with the same rules used by send and edit.
     */
    #[Required]
    public string $text;

    /**
     * Draft attachments keyed by attachment ID. Each attachment must reference an uploadID returned by the upload file endpoint.
     *
     * @var array<string,Attachment>|null $attachments
     */
    #[Optional(map: Attachment::class)]
    public ?array $attachments;

    /**
     * `new Draft()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Draft::with(text: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Draft)->withText(...)
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
     * @param array<string,Attachment|AttachmentShape>|null $attachments
     */
    public static function with(string $text, ?array $attachments = null): self
    {
        $self = new self;

        $self['text'] = $text;

        null !== $attachments && $self['attachments'] = $attachments;

        return $self;
    }

    /**
     * Draft text. Plain text and Markdown are converted to Beeper rich text with the same rules used by send and edit.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }

    /**
     * Draft attachments keyed by attachment ID. Each attachment must reference an uploadID returned by the upload file endpoint.
     *
     * @param array<string,Attachment|AttachmentShape> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }
}
