<?php

declare(strict_types=1);

namespace BeeperDesktop\Messages;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Messages\MessageSendParams\Attachment;

/**
 * Send a text message to a specific chat. Supports replying to existing messages. Returns a pending message ID.
 *
 * @see BeeperDesktop\Services\MessagesService::send()
 *
 * @phpstan-import-type AttachmentShape from \BeeperDesktop\Messages\MessageSendParams\Attachment
 *
 * @phpstan-type MessageSendParamsShape = array{
 *   attachment?: null|Attachment|AttachmentShape,
 *   replyToMessageID?: string|null,
 *   text?: string|null,
 * }
 */
final class MessageSendParams implements BaseModel
{
    /** @use SdkModel<MessageSendParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Single attachment to send with the message.
     */
    #[Optional]
    public ?Attachment $attachment;

    /**
     * Provide a message ID to send this as a reply to an existing message.
     */
    #[Optional]
    public ?string $replyToMessageID;

    /**
     * Text content of the message you want to send. You may use markdown.
     */
    #[Optional]
    public ?string $text;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Attachment|AttachmentShape|null $attachment
     */
    public static function with(
        Attachment|array|null $attachment = null,
        ?string $replyToMessageID = null,
        ?string $text = null,
    ): self {
        $self = new self;

        null !== $attachment && $self['attachment'] = $attachment;
        null !== $replyToMessageID && $self['replyToMessageID'] = $replyToMessageID;
        null !== $text && $self['text'] = $text;

        return $self;
    }

    /**
     * Single attachment to send with the message.
     *
     * @param Attachment|AttachmentShape $attachment
     */
    public function withAttachment(Attachment|array $attachment): self
    {
        $self = clone $this;
        $self['attachment'] = $attachment;

        return $self;
    }

    /**
     * Provide a message ID to send this as a reply to an existing message.
     */
    public function withReplyToMessageID(string $replyToMessageID): self
    {
        $self = clone $this;
        $self['replyToMessageID'] = $replyToMessageID;

        return $self;
    }

    /**
     * Text content of the message you want to send. You may use markdown.
     */
    public function withText(string $text): self
    {
        $self = clone $this;
        $self['text'] = $text;

        return $self;
    }
}
