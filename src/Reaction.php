<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * @phpstan-type ReactionShape = array{
 *   id: string,
 *   participantID: string,
 *   reactionKey: string,
 *   emoji?: bool|null,
 *   imgURL?: string|null,
 * }
 */
final class Reaction implements BaseModel
{
    /** @use SdkModel<ReactionShape> */
    use SdkModel;

    /**
     * Reaction ID. When a participant can react more than once, the ID is the participant ID concatenated with the reaction key; otherwise it equals the participant ID.
     */
    #[Required]
    public string $id;

    /**
     * User ID of the participant who reacted.
     */
    #[Required]
    public string $participantID;

    /**
     * The reaction key: an emoji (😄), a network-specific key, or a shortcode like "smiling-face".
     */
    #[Required]
    public string $reactionKey;

    /**
     * True if the reactionKey is an emoji.
     */
    #[Optional]
    public ?bool $emoji;

    /**
     * URL to the reaction's image. May be temporary or available only on this device; download promptly if durable access is needed.
     */
    #[Optional]
    public ?string $imgURL;

    /**
     * `new Reaction()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Reaction::with(id: ..., participantID: ..., reactionKey: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Reaction)->withID(...)->withParticipantID(...)->withReactionKey(...)
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
     */
    public static function with(
        string $id,
        string $participantID,
        string $reactionKey,
        ?bool $emoji = null,
        ?string $imgURL = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['participantID'] = $participantID;
        $self['reactionKey'] = $reactionKey;

        null !== $emoji && $self['emoji'] = $emoji;
        null !== $imgURL && $self['imgURL'] = $imgURL;

        return $self;
    }

    /**
     * Reaction ID. When a participant can react more than once, the ID is the participant ID concatenated with the reaction key; otherwise it equals the participant ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * User ID of the participant who reacted.
     */
    public function withParticipantID(string $participantID): self
    {
        $self = clone $this;
        $self['participantID'] = $participantID;

        return $self;
    }

    /**
     * The reaction key: an emoji (😄), a network-specific key, or a shortcode like "smiling-face".
     */
    public function withReactionKey(string $reactionKey): self
    {
        $self = clone $this;
        $self['reactionKey'] = $reactionKey;

        return $self;
    }

    /**
     * True if the reactionKey is an emoji.
     */
    public function withEmoji(bool $emoji): self
    {
        $self = clone $this;
        $self['emoji'] = $emoji;

        return $self;
    }

    /**
     * URL to the reaction's image. May be temporary or available only on this device; download promptly if durable access is needed.
     */
    public function withImgURL(string $imgURL): self
    {
        $self = clone $this;
        $self['imgURL'] = $imgURL;

        return $self;
    }
}
