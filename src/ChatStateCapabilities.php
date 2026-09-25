<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\ChatStateCapabilities\Avatar;
use BeeperDesktop\ChatStateCapabilities\Description;
use BeeperDesktop\ChatStateCapabilities\DisappearingTimer;
use BeeperDesktop\ChatStateCapabilities\Title;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Chat state update capabilities.
 *
 * @phpstan-import-type AvatarShape from \BeeperDesktop\ChatStateCapabilities\Avatar
 * @phpstan-import-type DescriptionShape from \BeeperDesktop\ChatStateCapabilities\Description
 * @phpstan-import-type DisappearingTimerShape from \BeeperDesktop\ChatStateCapabilities\DisappearingTimer
 * @phpstan-import-type TitleShape from \BeeperDesktop\ChatStateCapabilities\Title
 *
 * @phpstan-type ChatStateCapabilitiesShape = array{
 *   avatar?: null|Avatar|AvatarShape,
 *   description?: null|Description|DescriptionShape,
 *   disappearingTimer?: null|DisappearingTimer|DisappearingTimerShape,
 *   title?: null|Title|TitleShape,
 * }
 */
final class ChatStateCapabilities implements BaseModel
{
    /** @use SdkModel<ChatStateCapabilitiesShape> */
    use SdkModel;

    /**
     * Chat avatar state capability.
     */
    #[Optional]
    public ?Avatar $avatar;

    /**
     * Chat description/topic state capability.
     */
    #[Optional]
    public ?Description $description;

    /**
     * Disappearing-message timer state capability.
     */
    #[Optional]
    public ?DisappearingTimer $disappearingTimer;

    /**
     * Chat title state capability.
     */
    #[Optional]
    public ?Title $title;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Avatar|AvatarShape|null $avatar
     * @param Description|DescriptionShape|null $description
     * @param DisappearingTimer|DisappearingTimerShape|null $disappearingTimer
     * @param Title|TitleShape|null $title
     */
    public static function with(
        Avatar|array|null $avatar = null,
        Description|array|null $description = null,
        DisappearingTimer|array|null $disappearingTimer = null,
        Title|array|null $title = null,
    ): self {
        $self = new self;

        null !== $avatar && $self['avatar'] = $avatar;
        null !== $description && $self['description'] = $description;
        null !== $disappearingTimer && $self['disappearingTimer'] = $disappearingTimer;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    /**
     * Chat avatar state capability.
     *
     * @param Avatar|AvatarShape $avatar
     */
    public function withAvatar(Avatar|array $avatar): self
    {
        $self = clone $this;
        $self['avatar'] = $avatar;

        return $self;
    }

    /**
     * Chat description/topic state capability.
     *
     * @param Description|DescriptionShape $description
     */
    public function withDescription(Description|array $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Disappearing-message timer state capability.
     *
     * @param DisappearingTimer|DisappearingTimerShape $disappearingTimer
     */
    public function withDisappearingTimer(
        DisappearingTimer|array $disappearingTimer
    ): self {
        $self = clone $this;
        $self['disappearingTimer'] = $disappearingTimer;

        return $self;
    }

    /**
     * Chat title state capability.
     *
     * @param Title|TitleShape $title
     */
    public function withTitle(Title|array $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
