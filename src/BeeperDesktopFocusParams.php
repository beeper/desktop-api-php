<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Focus Beeper Desktop and optionally open a specific chat, jump to a message, or pre-fill text and an image.
 *
 * @see BeeperDesktop\Services\BeeperDesktopClientService::focus()
 *
 * @phpstan-type BeeperDesktopFocusParamsShape = array{
 *   chatID?: string|null,
 *   draftAttachmentPath?: string|null,
 *   draftText?: string|null,
 *   messageID?: string|null,
 * }
 */
final class BeeperDesktopFocusParams implements BaseModel
{
    /** @use SdkModel<BeeperDesktopFocusParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional Beeper chat ID (or local chat ID) to focus after opening the app. If omitted, only opens/focuses the app.
     */
    #[Optional]
    public ?string $chatID;

    /**
     * Optional local image path to populate in the message input field.
     */
    #[Optional]
    public ?string $draftAttachmentPath;

    /**
     * Optional plain text to populate in the message input field.
     */
    #[Optional]
    public ?string $draftText;

    /**
     * Optional message ID. Jumps to that message in the chat when opening.
     */
    #[Optional]
    public ?string $messageID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $chatID = null,
        ?string $draftAttachmentPath = null,
        ?string $draftText = null,
        ?string $messageID = null,
    ): self {
        $self = new self;

        null !== $chatID && $self['chatID'] = $chatID;
        null !== $draftAttachmentPath && $self['draftAttachmentPath'] = $draftAttachmentPath;
        null !== $draftText && $self['draftText'] = $draftText;
        null !== $messageID && $self['messageID'] = $messageID;

        return $self;
    }

    /**
     * Optional Beeper chat ID (or local chat ID) to focus after opening the app. If omitted, only opens/focuses the app.
     */
    public function withChatID(string $chatID): self
    {
        $self = clone $this;
        $self['chatID'] = $chatID;

        return $self;
    }

    /**
     * Optional local image path to populate in the message input field.
     */
    public function withDraftAttachmentPath(string $draftAttachmentPath): self
    {
        $self = clone $this;
        $self['draftAttachmentPath'] = $draftAttachmentPath;

        return $self;
    }

    /**
     * Optional plain text to populate in the message input field.
     */
    public function withDraftText(string $draftText): self
    {
        $self = clone $this;
        $self['draftText'] = $draftText;

        return $self;
    }

    /**
     * Optional message ID. Jumps to that message in the chat when opening.
     */
    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }
}
