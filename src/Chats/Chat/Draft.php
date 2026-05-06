<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat;

use BeeperDesktop\Chats\Chat\Draft\Attachment;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Current draft object for this chat, or null when no draft is set.
 *
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Chats\Chat\Draft\Attachment
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
     * Matrix HTML draft body.
     */
    #[Required]
    public string $text;

    /**
     * Draft attachments keyed by attachment ID.
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
     * Matrix HTML draft body.
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
     * @param array<string,Attachment|AttachmentShape> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }
}
