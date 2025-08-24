<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class ArchiveRequest implements BaseModel
{
    use SdkModel;

    /**
     * The identifier of the chat to archive or unarchive.
     */
    #[Api]
    public string $chatID;

    /**
     * True to archive, false to unarchive.
     */
    #[Api(optional: true)]
    public ?bool $archived;

    /**
     * `new ArchiveRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ArchiveRequest::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ArchiveRequest)->withChatID(...)
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
    public static function with(string $chatID, ?bool $archived = null): self
    {
        $obj = new self;

        $obj->chatID = $chatID;

        null !== $archived && $obj->archived = $archived;

        return $obj;
    }

    /**
     * The identifier of the chat to archive or unarchive.
     */
    public function withChatID(string $chatID): self
    {
        $obj = clone $this;
        $obj->chatID = $chatID;

        return $obj;
    }

    /**
     * True to archive, false to unarchive.
     */
    public function withArchived(bool $archived): self
    {
        $obj = clone $this;
        $obj->archived = $archived;

        return $obj;
    }
}
