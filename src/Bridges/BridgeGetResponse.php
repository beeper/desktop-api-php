<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Accounts\Account;
use BeeperDesktop\Bridges\BridgeGetResponse\Provider;
use BeeperDesktop\Bridges\BridgeGetResponse\Status;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Available bridge that can connect or reconnect chat accounts.
 *
 * @phpstan-import-type AccountShape from \BeeperDesktop\Accounts\Account
 *
 * @phpstan-type BridgeGetResponseShape = array{
 *   id: string,
 *   accounts: list<Account|AccountShape>,
 *   activeAccountCount: int,
 *   displayName: string,
 *   provider: Provider|value-of<Provider>,
 *   status: Status|value-of<Status>,
 *   supportsMultipleAccounts: bool,
 *   type: string,
 *   network?: string|null,
 *   statusText?: string|null,
 * }
 */
final class BridgeGetResponse implements BaseModel
{
    /** @use SdkModel<BridgeGetResponseShape> */
    use SdkModel;

    /**
     * Bridge ID. Use with bridge endpoints.
     */
    #[Required]
    public string $id;

    /**
     * Connected accounts for this bridge. Uses the same Account schema as GET /v1/accounts.
     *
     * @var list<Account> $accounts
     */
    #[Required(list: Account::class)]
    public array $accounts;

    /**
     * Number of active accounts for this network on this device.
     */
    #[Required]
    public int $activeAccountCount;

    /**
     * Human-friendly bridge name shown in Beeper.
     */
    #[Required]
    public string $displayName;

    /**
     * Where accounts for this bridge run: on this device or in Beeper Cloud.
     *
     * @var value-of<Provider> $provider
     */
    #[Required(enum: Provider::class)]
    public string $provider;

    /**
     * Whether this bridge can currently be used to connect new accounts.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Whether this bridge can have multiple active accounts for the same network.
     */
    #[Required]
    public bool $supportsMultipleAccounts;

    /**
     * Underlying bridge type, such as matrix, discordgo, slackgo, whatsapp, telegram, or twitter.
     */
    #[Required]
    public string $type;

    /**
     * Network grouping used for account counts and limits.
     */
    #[Optional]
    public ?string $network;

    /**
     * Human-friendly status text matching Beeper account management language.
     */
    #[Optional]
    public ?string $statusText;

    /**
     * `new BridgeGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BridgeGetResponse::with(
     *   id: ...,
     *   accounts: ...,
     *   activeAccountCount: ...,
     *   displayName: ...,
     *   provider: ...,
     *   status: ...,
     *   supportsMultipleAccounts: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BridgeGetResponse)
     *   ->withID(...)
     *   ->withAccounts(...)
     *   ->withActiveAccountCount(...)
     *   ->withDisplayName(...)
     *   ->withProvider(...)
     *   ->withStatus(...)
     *   ->withSupportsMultipleAccounts(...)
     *   ->withType(...)
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
     * @param list<Account|AccountShape> $accounts
     * @param Provider|value-of<Provider> $provider
     * @param Status|value-of<Status> $status
     */
    public static function with(
        string $id,
        array $accounts,
        int $activeAccountCount,
        string $displayName,
        Provider|string $provider,
        Status|string $status,
        bool $supportsMultipleAccounts,
        string $type,
        ?string $network = null,
        ?string $statusText = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['accounts'] = $accounts;
        $self['activeAccountCount'] = $activeAccountCount;
        $self['displayName'] = $displayName;
        $self['provider'] = $provider;
        $self['status'] = $status;
        $self['supportsMultipleAccounts'] = $supportsMultipleAccounts;
        $self['type'] = $type;

        null !== $network && $self['network'] = $network;
        null !== $statusText && $self['statusText'] = $statusText;

        return $self;
    }

    /**
     * Bridge ID. Use with bridge endpoints.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Connected accounts for this bridge. Uses the same Account schema as GET /v1/accounts.
     *
     * @param list<Account|AccountShape> $accounts
     */
    public function withAccounts(array $accounts): self
    {
        $self = clone $this;
        $self['accounts'] = $accounts;

        return $self;
    }

    /**
     * Number of active accounts for this network on this device.
     */
    public function withActiveAccountCount(int $activeAccountCount): self
    {
        $self = clone $this;
        $self['activeAccountCount'] = $activeAccountCount;

        return $self;
    }

    /**
     * Human-friendly bridge name shown in Beeper.
     */
    public function withDisplayName(string $displayName): self
    {
        $self = clone $this;
        $self['displayName'] = $displayName;

        return $self;
    }

    /**
     * Where accounts for this bridge run: on this device or in Beeper Cloud.
     *
     * @param Provider|value-of<Provider> $provider
     */
    public function withProvider(Provider|string $provider): self
    {
        $self = clone $this;
        $self['provider'] = $provider;

        return $self;
    }

    /**
     * Whether this bridge can currently be used to connect new accounts.
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
     * Whether this bridge can have multiple active accounts for the same network.
     */
    public function withSupportsMultipleAccounts(
        bool $supportsMultipleAccounts
    ): self {
        $self = clone $this;
        $self['supportsMultipleAccounts'] = $supportsMultipleAccounts;

        return $self;
    }

    /**
     * Underlying bridge type, such as matrix, discordgo, slackgo, whatsapp, telegram, or twitter.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Network grouping used for account counts and limits.
     */
    public function withNetwork(string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * Human-friendly status text matching Beeper account management language.
     */
    public function withStatusText(string $statusText): self
    {
        $self = clone $this;
        $self['statusText'] = $statusText;

        return $self;
    }
}
