<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Retrieve chat details including metadata, participants, and latest message.
 *
 * @see BeeperDesktop\Services\ChatsService::retrieve()
 *
 * @phpstan-type ChatRetrieveParamsShape = array{maxParticipantCount?: int|null}
 */
final class ChatRetrieveParams implements BaseModel
{
    /** @use SdkModel<ChatRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Maximum number of participants to return. Use -1 for all; otherwise 0-500. Defaults to 100. List and search endpoints return up to 20 participants per chat.
     */
    #[Optional(nullable: true)]
    public ?int $maxParticipantCount;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?int $maxParticipantCount = null): self
    {
        $self = new self;

        null !== $maxParticipantCount && $self['maxParticipantCount'] = $maxParticipantCount;

        return $self;
    }

    /**
     * Maximum number of participants to return. Use -1 for all; otherwise 0-500. Defaults to 100. List and search endpoints return up to 20 participants per chat.
     */
    public function withMaxParticipantCount(?int $maxParticipantCount): self
    {
        $self = clone $this;
        $self['maxParticipantCount'] = $maxParticipantCount;

        return $self;
    }
}
