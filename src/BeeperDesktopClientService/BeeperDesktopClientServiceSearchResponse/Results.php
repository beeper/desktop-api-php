<?php

declare(strict_types=1);

namespace BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse;

use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse\Results\Messages;
use BeeperDesktop\Chats\Chat;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type ChatShape from \BeeperDesktop\Chats\Chat
 * @phpstan-import-type MessagesShape from \BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse\Results\Messages
 *
 * @phpstan-type ResultsShape = array{
 *   chats: list<Chat|ChatShape>,
 *   inGroups: list<Chat|ChatShape>,
 *   messages: Messages|MessagesShape,
 * }
 */
final class Results implements BaseModel
{
    /** @use SdkModel<ResultsShape> */
    use SdkModel;

    /**
     * Top chat results.
     *
     * @var list<Chat> $chats
     */
    #[Required(list: Chat::class)]
    public array $chats;

    /**
     * Top group results by participant matches.
     *
     * @var list<Chat> $inGroups
     */
    #[Required('in_groups', list: Chat::class)]
    public array $inGroups;

    #[Required]
    public Messages $messages;

    /**
     * `new Results()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Results::with(chats: ..., inGroups: ..., messages: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Results)->withChats(...)->withInGroups(...)->withMessages(...)
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
     * @param list<Chat|ChatShape> $chats
     * @param list<Chat|ChatShape> $inGroups
     * @param Messages|MessagesShape $messages
     */
    public static function with(
        array $chats,
        array $inGroups,
        Messages|array $messages
    ): self {
        $self = new self;

        $self['chats'] = $chats;
        $self['inGroups'] = $inGroups;
        $self['messages'] = $messages;

        return $self;
    }

    /**
     * Top chat results.
     *
     * @param list<Chat|ChatShape> $chats
     */
    public function withChats(array $chats): self
    {
        $self = clone $this;
        $self['chats'] = $chats;

        return $self;
    }

    /**
     * Top group results by participant matches.
     *
     * @param list<Chat|ChatShape> $inGroups
     */
    public function withInGroups(array $inGroups): self
    {
        $self = clone $this;
        $self['inGroups'] = $inGroups;

        return $self;
    }

    /**
     * @param Messages|MessagesShape $messages
     */
    public function withMessages(Messages|array $messages): self
    {
        $self = clone $this;
        $self['messages'] = $messages;

        return $self;
    }
}
