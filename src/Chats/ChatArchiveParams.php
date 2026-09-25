<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Archive or unarchive a chat. Set archived=true to move it to Archive, or archived=false to move it back to the inbox.
 *
 * @see BeeperDesktop\Services\ChatsService::archive()
 *
 * @phpstan-type ChatArchiveParamsShape = array{archived?: bool|null}
 */
final class ChatArchiveParams implements BaseModel
{
    /** @use SdkModel<ChatArchiveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * True to archive, false to unarchive.
     */
    #[Optional]
    public ?bool $archived;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?bool $archived = null): self
    {
        $self = new self;

        null !== $archived && $self['archived'] = $archived;

        return $self;
    }

    /**
     * True to archive, false to unarchive.
     */
    public function withArchived(bool $archived): self
    {
        $self = clone $this;
        $self['archived'] = $archived;

        return $self;
    }
}
