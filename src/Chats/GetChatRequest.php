<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class GetChatRequest implements BaseModel
{
    use SdkModel;

    /**
     * Unique identifier of the chat to retrieve. Not available for iMessage chats. Participants are limited by 'maxParticipantCount'.
     */
    #[Api]
    public string $chatID;

    /**
     * Maximum number of participants to return. Use -1 for all; otherwise 0–500. Defaults to 20.
     */
    #[Api(nullable: true, optional: true)]
    public ?int $maxParticipantCount;

    /**
     * `new GetChatRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * GetChatRequest::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new GetChatRequest)->withChatID(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        string $chatID,
        ?int $maxParticipantCount = null
    ): self {
        $obj = new self;

        $obj->chatID = $chatID;

        null !== $maxParticipantCount && $obj->maxParticipantCount = $maxParticipantCount;

        return $obj;
    }

    /**
     * Unique identifier of the chat to retrieve. Not available for iMessage chats. Participants are limited by 'maxParticipantCount'.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * Maximum number of participants to return. Use -1 for all; otherwise 0–500. Defaults to 20.
     */
    public function withMaxParticipantCount(?int $maxParticipantCount): self
    {
        $obj = clone $this;
        $obj->maxParticipantCount = $maxParticipantCount;

        return $obj;
    }
}
