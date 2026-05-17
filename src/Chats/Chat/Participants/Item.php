<?php

declare(strict_types=1);

namespace BeeperDesktop\Chats\Chat\Participants;

use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * A chat participant. Extends User with chat membership metadata.
 *
 * @phpstan-type ItemShape = array{
 *   id: string,
 *   cannotMessage?: bool|null,
 *   email?: string|null,
 *   fullName?: string|null,
 *   imgURL?: string|null,
 *   isSelf?: bool|null,
 *   phoneNumber?: string|null,
 *   username?: string|null,
 *   isAdmin?: bool|null,
 *   isNetworkBot?: bool|null,
 *   isPending?: bool|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * Stable Beeper user ID. Use as the primary key when referencing a person.
     */
    #[Required]
    public string $id;

    /**
     * True if Beeper cannot initiate messages to this user (e.g., blocked, network restriction, or no DM path). The user may still message you.
     */
    #[Optional]
    public ?bool $cannotMessage;

    /**
     * Email address if known. Not guaranteed verified.
     */
    #[Optional]
    public ?string $email;

    /**
     * Display name as shown in clients (e.g., 'Alice Example'). May include emojis.
     */
    #[Optional]
    public ?string $fullName;

    /**
     * Avatar image URL if available. This may be a remote URL, media URL, data URL, or local file URL depending on the source. May be temporary or available only on this device; download promptly if durable access is needed.
     */
    #[Optional]
    public ?string $imgURL;

    /**
     * True if this user represents the authenticated account's own identity.
     */
    #[Optional]
    public ?bool $isSelf;

    /**
     * User's phone number in E.164 format (e.g., '+14155552671'). Omit if unknown.
     */
    #[Optional]
    public ?string $phoneNumber;

    /**
     * Human-readable handle if available (e.g., '@alice'). May be network-specific and not globally unique.
     */
    #[Optional]
    public ?string $username;

    /**
     * True if this participant has admin privileges in the chat.
     */
    #[Optional]
    public ?bool $isAdmin;

    /**
     * True if this participant represents an automated network account.
     */
    #[Optional]
    public ?bool $isNetworkBot;

    /**
     * True if this participant has been invited but has not joined yet.
     */
    #[Optional]
    public ?bool $isPending;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)->withID(...)
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
        ?bool $cannotMessage = null,
        ?string $email = null,
        ?string $fullName = null,
        ?string $imgURL = null,
        ?bool $isSelf = null,
        ?string $phoneNumber = null,
        ?string $username = null,
        ?bool $isAdmin = null,
        ?bool $isNetworkBot = null,
        ?bool $isPending = null,
    ): self {
        $self = new self;

        $self['id'] = $id;

        null !== $cannotMessage && $self['cannotMessage'] = $cannotMessage;
        null !== $email && $self['email'] = $email;
        null !== $fullName && $self['fullName'] = $fullName;
        null !== $imgURL && $self['imgURL'] = $imgURL;
        null !== $isSelf && $self['isSelf'] = $isSelf;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $username && $self['username'] = $username;
        null !== $isAdmin && $self['isAdmin'] = $isAdmin;
        null !== $isNetworkBot && $self['isNetworkBot'] = $isNetworkBot;
        null !== $isPending && $self['isPending'] = $isPending;

        return $self;
    }

    /**
     * Stable Beeper user ID. Use as the primary key when referencing a person.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * True if Beeper cannot initiate messages to this user (e.g., blocked, network restriction, or no DM path). The user may still message you.
     */
    public function withCannotMessage(bool $cannotMessage): self
    {
        $self = clone $this;
        $self['cannotMessage'] = $cannotMessage;

        return $self;
    }

    /**
     * Email address if known. Not guaranteed verified.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Display name as shown in clients (e.g., 'Alice Example'). May include emojis.
     */
    public function withFullName(string $fullName): self
    {
        $self = clone $this;
        $self['fullName'] = $fullName;

        return $self;
    }

    /**
     * Avatar image URL if available. This may be a remote URL, media URL, data URL, or local file URL depending on the source. May be temporary or available only on this device; download promptly if durable access is needed.
     */
    public function withImgURL(string $imgURL): self
    {
        $self = clone $this;
        $self['imgURL'] = $imgURL;

        return $self;
    }

    /**
     * True if this user represents the authenticated account's own identity.
     */
    public function withIsSelf(bool $isSelf): self
    {
        $self = clone $this;
        $self['isSelf'] = $isSelf;

        return $self;
    }

    /**
     * User's phone number in E.164 format (e.g., '+14155552671'). Omit if unknown.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * Human-readable handle if available (e.g., '@alice'). May be network-specific and not globally unique.
     */
    public function withUsername(string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }

    /**
     * True if this participant has admin privileges in the chat.
     */
    public function withIsAdmin(bool $isAdmin): self
    {
        $self = clone $this;
        $self['isAdmin'] = $isAdmin;

        return $self;
    }

    /**
     * True if this participant represents an automated network account.
     */
    public function withIsNetworkBot(bool $isNetworkBot): self
    {
        $self = clone $this;
        $self['isNetworkBot'] = $isNetworkBot;

        return $self;
    }

    /**
     * True if this participant has been invited but has not joined yet.
     */
    public function withIsPending(bool $isPending): self
    {
        $self = clone $this;
        $self['isPending'] = $isPending;

        return $self;
    }
}
