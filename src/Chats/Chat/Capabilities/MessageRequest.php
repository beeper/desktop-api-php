<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Capabilities;

use BeeperDesktop\Chats\Chat\Capabilities\MessageRequest\AcceptWithButton;
use BeeperDesktop\Chats\Chat\Capabilities\MessageRequest\AcceptWithMessage;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Message request capabilities.
 *
 * @phpstan-type MessageRequestShape = array{
 *   acceptWithButton?: null|AcceptWithButton|value-of<AcceptWithButton>,
 *   acceptWithMessage?: null|AcceptWithMessage|value-of<AcceptWithMessage>,
 * }
 */
final class MessageRequest implements BaseModel
{
    /** @use SdkModel<MessageRequestShape> */
    use SdkModel;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<AcceptWithButton>|null $acceptWithButton
     */
    #[Optional(enum: AcceptWithButton::class)]
    public ?int $acceptWithButton;

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @var value-of<AcceptWithMessage>|null $acceptWithMessage
     */
    #[Optional(enum: AcceptWithMessage::class)]
    public ?int $acceptWithMessage;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AcceptWithButton|value-of<AcceptWithButton>|null $acceptWithButton
     * @param AcceptWithMessage|value-of<AcceptWithMessage>|null $acceptWithMessage
     */
    public static function with(
        AcceptWithButton|int|null $acceptWithButton = null,
        AcceptWithMessage|int|null $acceptWithMessage = null,
    ): self {
        $self = new self;

        null !== $acceptWithButton && $self['acceptWithButton'] = $acceptWithButton;
        null !== $acceptWithMessage && $self['acceptWithMessage'] = $acceptWithMessage;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param AcceptWithButton|value-of<AcceptWithButton> $acceptWithButton
     */
    public function withAcceptWithButton(
        AcceptWithButton|int $acceptWithButton
    ): self {
        $self = clone $this;
        $self['acceptWithButton'] = $acceptWithButton;

        return $self;
    }

    /**
     * -2: rejected, -1: dropped, 0: unsupported, 1: partially supported, 2: fully supported.
     *
     * @param AcceptWithMessage|value-of<AcceptWithMessage> $acceptWithMessage
     */
    public function withAcceptWithMessage(
        AcceptWithMessage|int $acceptWithMessage
    ): self {
        $self = clone $this;
        $self['acceptWithMessage'] = $acceptWithMessage;

        return $self;
    }
}
