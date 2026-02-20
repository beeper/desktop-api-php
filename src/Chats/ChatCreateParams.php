<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats;

use BeeperDesktop\Chats\ChatCreateParams\Chat;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Concerns\SdkParams;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Create a single/group chat (mode='create') or start a direct chat from merged user data (mode='start').
 *
 * @see BeeperDesktop\Services\ChatsService::create()
 *
 * @phpstan-import-type ChatShape from \BeeperDesktop\Chats\ChatCreateParams\Chat
 *
 * @phpstan-type ChatCreateParamsShape = array{
 *   chat: \BeeperDesktop\Chats\ChatCreateParams\Chat|ChatShape
 * }
 */
final class ChatCreateParams implements BaseModel
{
    /** @use SdkModel<ChatCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public Chat $chat;

    /**
     * `new ChatCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ChatCreateParams::with(chat: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ChatCreateParams)->withChat(...)
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
     * @param Chat|ChatShape $chat
     */
    public static function with(
        Chat|array $chat
    ): self {
        $self = new self;

        $self['chat'] = $chat;

        return $self;
    }

    /**
     * @param Chat|ChatShape $chat
     */
    public function withChat(
        Chat|array $chat
    ): self {
        $self = clone $this;
        $self['chat'] = $chat;

        return $self;
    }
}
