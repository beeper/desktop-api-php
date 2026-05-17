<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts;

use BeeperDesktop\Accounts\AccountGetResponse\Status;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;
use BeeperDesktop\Core\Conversion\MapOf;
use BeeperDesktop\User;

/**
 * A chat account added to Beeper.
 *
 * @phpstan-import-type AccountBridgeShape from \BeeperDesktop\Accounts\AccountBridge
 * @phpstan-import-type UserShape from \BeeperDesktop\User
 *
 * @phpstan-type AccountGetResponseShape = array{
 *   accountID: string,
 *   bridge: AccountBridge|AccountBridgeShape,
 *   status: Status|value-of<Status>,
 *   user: User|UserShape,
 *   capabilities?: array<string,mixed>|null,
 *   loginID?: string|null,
 *   network?: string|null,
 *   statusText?: string|null,
 * }
 */
final class AccountGetResponse implements BaseModel
{
    /** @use SdkModel<AccountGetResponseShape> */
    use SdkModel;

    /**
     * Chat account added to Beeper. Use this to route account-scoped actions. Examples include matrix for Beeper/Matrix, discordgo for a cloud bridge, slackgo.TEAM-USER for workspace-scoped cloud bridges, and local-whatsapp_ba_... for local bridges.
     */
    #[Required]
    public string $accountID;

    /**
     * Bridge metadata for the account. Available in Beeper Desktop v4.2.785+.
     */
    #[Required]
    public AccountBridge $bridge;

    /**
     * Current connection status for this account.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * User the account belongs to.
     */
    #[Required]
    public User $user;

    /**
     * Runtime chat/message capabilities for this connected account, when available.
     *
     * @var array<string,mixed>|null $capabilities
     */
    #[Optional(type: new MapOf('mixed', nullable: true))]
    public ?array $capabilities;

    /**
     * Bridge login ID for this account, when known. One bridge login can contain multiple chat accounts.
     */
    #[Optional]
    public ?string $loginID;

    /**
     * Human-friendly network name for the account. Omitted when the network is unknown.
     */
    #[Optional]
    public ?string $network;

    /**
     * Human-friendly account status text.
     */
    #[Optional]
    public ?string $statusText;

    /**
     * `new AccountGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountGetResponse::with(accountID: ..., bridge: ..., status: ..., user: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountGetResponse)
     *   ->withAccountID(...)
     *   ->withBridge(...)
     *   ->withStatus(...)
     *   ->withUser(...)
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
     * @param AccountBridge|AccountBridgeShape $bridge
     * @param Status|value-of<Status> $status
     * @param User|UserShape $user
     * @param array<string,mixed>|null $capabilities
     */
    public static function with(
        string $accountID,
        AccountBridge|array $bridge,
        Status|string $status,
        User|array $user,
        ?array $capabilities = null,
        ?string $loginID = null,
        ?string $network = null,
        ?string $statusText = null,
    ): self {
        $self = new self;

        $self['accountID'] = $accountID;
        $self['bridge'] = $bridge;
        $self['status'] = $status;
        $self['user'] = $user;

        null !== $capabilities && $self['capabilities'] = $capabilities;
        null !== $loginID && $self['loginID'] = $loginID;
        null !== $network && $self['network'] = $network;
        null !== $statusText && $self['statusText'] = $statusText;

        return $self;
    }

    /**
     * Chat account added to Beeper. Use this to route account-scoped actions. Examples include matrix for Beeper/Matrix, discordgo for a cloud bridge, slackgo.TEAM-USER for workspace-scoped cloud bridges, and local-whatsapp_ba_... for local bridges.
     */
    public function withAccountID(string $accountID): self
    {
        $self = clone $this;
        $self['accountID'] = $accountID;

        return $self;
    }

    /**
     * Bridge metadata for the account. Available in Beeper Desktop v4.2.785+.
     *
     * @param AccountBridge|AccountBridgeShape $bridge
     */
    public function withBridge(AccountBridge|array $bridge): self
    {
        $self = clone $this;
        $self['bridge'] = $bridge;

        return $self;
    }

    /**
     * Current connection status for this account.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * User the account belongs to.
     *
     * @param User|UserShape $user
     */
    public function withUser(User|array $user): self
    {
        $self = clone $this;
        $self['user'] = $user;

        return $self;
    }

    /**
     * Runtime chat/message capabilities for this connected account, when available.
     *
     * @param array<string,mixed> $capabilities
     */
    public function withCapabilities(array $capabilities): self
    {
        $self = clone $this;
        $self['capabilities'] = $capabilities;

        return $self;
    }

    /**
     * Bridge login ID for this account, when known. One bridge login can contain multiple chat accounts.
     */
    public function withLoginID(string $loginID): self
    {
        $self = clone $this;
        $self['loginID'] = $loginID;

        return $self;
    }

    /**
     * Human-friendly network name for the account. Omitted when the network is unknown.
     */
    public function withNetwork(string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * Human-friendly account status text.
     */
    public function withStatusText(string $statusText): self
    {
        $self = clone $this;
        $self['statusText'] = $statusText;

        return $self;
    }
}
