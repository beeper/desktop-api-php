<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Present when this chat is a merged chat: one person whose conversations across networks (or across accounts on the same network) are grouped into a single chat. A merged chat holds no messages of its own - read messages from the member chats, and send either to a member directly or to the merged chat ID to route automatically.
 *
 * @phpstan-type MergeShape = array{
 *   chatIDs: list<string>, defaultChatID?: string|null
 * }
 */
final class Merge implements BaseModel
{
    /** @use SdkModel<MergeShape> */
    use SdkModel;

    /**
     * Chat IDs of the member chats grouped by this merged chat.
     *
     * @var list<string> $chatIDs
     */
    #[Required(list: 'string')]
    public array $chatIDs;

    /**
     * Member chat that receives messages sent to the merged chat, when the user has picked one. This preference is per-device; when absent, sends route to the most recently active member.
     */
    #[Optional]
    public ?string $defaultChatID;

    /**
     * `new Merge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Merge::with(chatIDs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Merge)->withChatIDs(...)
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
     * @param list<string> $chatIDs
     */
    public static function with(
        array $chatIDs,
        ?string $defaultChatID = null
    ): self {
        $self = new self;

        $self['chatIDs'] = $chatIDs;

        null !== $defaultChatID && $self['defaultChatID'] = $defaultChatID;

        return $self;
    }

    /**
     * Chat IDs of the member chats grouped by this merged chat.
     *
     * @param list<string> $chatIDs
     */
    public function withChatIDs(array $chatIDs): self
    {
        $self = clone $this;
        $self['chatIDs'] = $chatIDs;

        return $self;
    }

    /**
     * Member chat that receives messages sent to the merged chat, when the user has picked one. This preference is per-device; when absent, sends route to the most recently active member.
     */
    public function withDefaultChatID(string $defaultChatID): self
    {
        $self = clone $this;
        $self['defaultChatID'] = $defaultChatID;

        return $self;
    }
}
