<?php

declare(strict_types=1);

namespace BeeperDesktop\Shared;

use BeeperDesktop\Core\Attributes\Api;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * A person on or reachable through Beeper. Values are best-effort and can vary by network.
 */
final class User implements BaseModel
{
    use SdkModel;

    /**
     * Stable Beeper user ID. Use as the primary key when referencing a person.
     */
    #[Api]
    public string $id;

    /**
     * True if Beeper cannot initiate messages to this user (e.g., blocked, network restriction, or no DM path). The user may still message you.
     */
    #[Api(optional: true)]
    public ?bool $cannotMessage;

    /**
     * Email address if known. Not guaranteed verified.
     */
    #[Api(optional: true)]
    public ?string $email;

    /**
     * Display name as shown in clients (e.g., 'Alice Example'). May include emojis.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $fullName;

    /**
     * Avatar image URL if available. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    #[Api(optional: true)]
    public ?string $imgURL;

    /**
     * True if this user represents the authenticated account's own identity.
     */
    #[Api(optional: true)]
    public ?bool $isSelf;

    /**
     * User's phone number in E.164 format (e.g., '+14155552671'). Omit if unknown.
     */
    #[Api(optional: true)]
    public ?string $phoneNumber;

    /**
     * Human-readable handle if available (e.g., '@alice'). May be network-specific and not globally unique.
     */
    #[Api(optional: true)]
    public ?string $username;

    /**
     * `new User()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * User::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new User)->withID(...)
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
        ?bool $cannotMessage = null,
        ?string $email = null,
        ?string $fullName = null,
        ?string $imgURL = null,
        ?bool $isSelf = null,
        ?string $phoneNumber = null,
        ?string $username = null,
    ): self {
        $obj = new self;

        $obj->id = $id;

        null !== $cannotMessage && $obj->cannotMessage = $cannotMessage;
        null !== $email && $obj->email = $email;
        null !== $fullName && $obj->fullName = $fullName;
        null !== $imgURL && $obj->imgURL = $imgURL;
        null !== $isSelf && $obj->isSelf = $isSelf;
        null !== $phoneNumber && $obj->phoneNumber = $phoneNumber;
        null !== $username && $obj->username = $username;

        return $obj;
    }

    /**
     * Stable Beeper user ID. Use as the primary key when referencing a person.
     */
    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * True if Beeper cannot initiate messages to this user (e.g., blocked, network restriction, or no DM path). The user may still message you.
     */
    public function withCannotMessage(bool $cannotMessage): self
    {
        $obj = clone $this;
        $obj->cannotMessage = $cannotMessage;

        return $obj;
    }

    /**
     * Email address if known. Not guaranteed verified.
     */
    public function withEmail(string $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }

    /**
     * Display name as shown in clients (e.g., 'Alice Example'). May include emojis.
     */
    public function withFullName(?string $fullName): self
    {
        $obj = clone $this;
        $obj->fullName = $fullName;

        return $obj;
    }

    /**
     * Avatar image URL if available. May be temporary or local-only to this device; download promptly if durable access is needed.
     */
    public function withImgURL(string $imgURL): self
    {
        $obj = clone $this;
        $obj->imgURL = $imgURL;

        return $obj;
    }

    /**
     * True if this user represents the authenticated account's own identity.
     */
    public function withIsSelf(bool $isSelf): self
    {
        $obj = clone $this;
        $obj->isSelf = $isSelf;

        return $obj;
    }

    /**
     * User's phone number in E.164 format (e.g., '+14155552671'). Omit if unknown.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $obj = clone $this;
        $obj->phoneNumber = $phoneNumber;

        return $obj;
    }

    /**
     * Human-readable handle if available (e.g., '@alice'). May be network-specific and not globally unique.
     */
    public function withUsername(string $username): self
    {
        $obj = clone $this;
        $obj->username = $username;

        return $obj;
    }
}
