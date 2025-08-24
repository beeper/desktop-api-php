<?php

declare(strict_types=1);

namespace BeeperDesktop\Shared;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

final class Reaction implements BaseModel
{
    use SdkModel;

    /**
     * Reaction ID, typically ${participantID}${reactionKey} if multiple reactions allowed, or just participantID otherwise.
     */
    #[Api]
    public string $id;

    /**
     * User ID of the participant who reacted.
     */
    #[Api]
    public string $participantID;

    /**
     * The reaction key: an emoji (😄), a network-specific key, or a shortcode like "smiling-face".
     */
    #[Api]
    public string $reactionKey;

    /**
     * True if the reactionKey is an emoji.
     */
    #[Api(optional: true)]
    public ?bool $emoji;

    /**
     * URL to the reaction's image. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    #[Api(optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
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
        $obj = new self;

        $obj->id = $id;
        $obj->participantID = $participantID;
        $obj->reactionKey = $reactionKey;

        null !== $emoji && $obj->emoji = $emoji;
        null !== $imgURL && $obj->imgURL = $imgURL;

        return $obj;
    }

    /**
     * Reaction ID, typically ${participantID}${reactionKey} if multiple reactions allowed, or just participantID otherwise.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * User ID of the participant who reacted.
     */
    public function withParticipantID(string $participantID): self
    {
        $obj = clone $this;
        $obj->participantID = $participantID;

        return $obj;
    }

    /**
     * The reaction key: an emoji (😄), a network-specific key, or a shortcode like "smiling-face".
     */
    public function withReactionKey(string $reactionKey): self
    {
        $obj = clone $this;
        $obj->reactionKey = $reactionKey;

        return $obj;
    }

    /**
     * True if the reactionKey is an emoji.
     */
    public function withEmoji(bool $emoji): self
    {
        $obj = clone $this;
        $obj->emoji = $emoji;

        return $obj;
    }

    /**
     * URL to the reaction's image. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    public function withImgURL(string $imgURL): self
    {
        $obj = clone $this;
        $obj->imgURL = $imgURL;

        return $obj;
    }
}
