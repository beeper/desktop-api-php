<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\ChatCreateParams\Params;

use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember1\Mode;
use BeeperDesktop\Chats\ChatCreateParams\Params\UnionMember1\Type;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type UnionMember1Shape = array{
 *   accountID: string,
 *   participantIDs: list<string>,
 *   type: Type|value-of<Type>,
 *   messageText?: string|null,
 *   mode?: null|Mode|value-of<Mode>,
 *   title?: string|null,
 * }
 */
final class UnionMember1 implements BaseModel
{
    /** @use SdkModel<UnionMember1Shape> */
    use SdkModel;

    /**
     * Account to create or start the chat on.
     */
    #[Required]
    public string $accountID;

    /**
     * User IDs to include in the new chat.
     *
     * @var list<string> $participantIDs
     */
    #[Required(list: 'string')]
    public array $participantIDs;

    /**
     * 'single' requires exactly one participantID; 'group' supports multiple participants and optional title.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * Optional first message content if the platform requires it to create the chat.
     */
    #[Optional]
    public ?string $messageText;

    /**
     * Operation mode. Defaults to 'create' when omitted.
     *
     * @var value-of<Mode>|null $mode
     */
    #[Optional(enum: Mode::class)]
    public ?string $mode;

    /**
     * Optional title for group chats; ignored for single chats on most platforms.
     */
    #[Optional]
    public ?string $title;

    /**
     * `new UnionMember1()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UnionMember1::with(accountID: ..., participantIDs: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UnionMember1)->withAccountID(...)->withParticipantIDs(...)->withType(...)
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
     * @param list<string> $participantIDs
     * @param Type|value-of<Type> $type
     * @param Mode|value-of<Mode>|null $mode
     */
    public static function with(
        string $accountID,
        array $participantIDs,
        Type|string $type,
        ?string $messageText = null,
        Mode|string|null $mode = null,
        ?string $title = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['participantIDs'] = $participantIDs;
        $self['type'] = $type;

        null !== $messageText && $self['messageText'] = $messageText;
        null !== $mode && $self['mode'] = $mode;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * Account to create or start the chat on.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * User IDs to include in the new chat.
     *
     * @param list<string> $participantIDs
     */
    public function withParticipantIDs(array $participantIDs): self
    {
        $self = clone $this;
        $self['participantIDs'] = $participantIDs;

        return $self;
    }

    /**
     * 'single' requires exactly one participantID; 'group' supports multiple participants and optional title.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Optional first message content if the platform requires it to create the chat.
     */
    public function withMessageText(string $messageText): self
    {
        $self = clone $this;
        $self['messageText'] = $messageText;

        return $self;
    }

    /**
     * Operation mode. Defaults to 'create' when omitted.
     *
     * @param Mode|value-of<Mode> $mode
     */
    public function withMode(Mode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Optional title for group chats; ignored for single chats on most platforms.
     */
    public function withTitle(string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
