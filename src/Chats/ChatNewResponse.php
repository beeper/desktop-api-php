<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\ChatNewResponse\Status;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type ChatNewResponseShape = array{
 *   chatID: string, status?: null|Status|value-of<Status>
 * }
 */
final class ChatNewResponse implements BaseModel
{
    /** @use SdkModel<ChatNewResponseShape> */
    use SdkModel;

    /**
     * Newly created chat ID.
     */
    #[Required]
    public string $chatID;

    /**
     * Only returned in start mode. 'existing' means an existing chat was reused; 'created' means a new chat was created.
     *
     * @var value-of<Status>|null $status
     */
    #[Optional(enum: Status::class)]
    public ?string $status;

    /**
     * `new ChatNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatNewResponse::with(chatID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatNewResponse)->withChatID(...)
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
     * @param Status|value-of<Status>|null $status
     */
    public static function with(
        string $chatID,
        Status|string|null $status = null
    ): self {
        $self = new self;

        $self['chatID'] = $chatID;

        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * Newly created chat ID.
     */
    public function withChatID(string $chatID): self
    {
        $self = clone $this;
        $self['chatID'] = $chatID;

        return $self;
    }

    /**
     * Only returned in start mode. 'existing' means an existing chat was reused; 'created' means a new chat was created.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
