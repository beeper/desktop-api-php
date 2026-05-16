<?php

declare(strict_types=1);

namespace BeeperDesktop\Matrix\Bridges\Rooms\RoomCreateGroupParams;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * The `m.room.topic` event content for the room.
 *
 * @phpstan-type TopicShape = array{topic?: string|null}
 */
final class Topic implements BaseModel
{
    /** @use SdkModel<TopicShape> */
    use SdkModel;

    #[Optional]
    public ?string $topic;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $topic = null): self
    {
        $self = new self;

        null !== $topic && $self['topic'] = $topic;

        return $self;
    }

    public function withTopic(string $topic): self
    {
        $self = clone $this;
        $self['topic'] = $topic;

        return $self;
    }
}
