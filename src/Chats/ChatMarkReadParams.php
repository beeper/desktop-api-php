<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Mark a chat as read, optionally through a specific message ID.
 *
 * @see BeeperDesktop\Services\ChatsService::markRead()
 *
 * @phpstan-type ChatMarkReadParamsShape = array{messageID?: string|null}
 */
final class ChatMarkReadParams implements BaseModel
{
    /** @use SdkModel<ChatMarkReadParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Optional message ID to mark read through.
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
    public static function with(?string $messageID = null): self
    {
        $self = new self;

        null !== $messageID && $self['messageID'] = $messageID;

        return $self;
    }

    /**
     * Optional message ID to mark read through.
     */
    public function withMessageID(string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }
}
