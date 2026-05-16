<?php

declare(strict_types=1);

namespace BeeperDesktop\Bridges;

use BeeperDesktop\Accounts\Account;
use BeeperDesktop\Bridges\BridgeAvailability\Bridge;
use BeeperDesktop\Bridges\BridgeAvailability\Status;
use BeeperDesktop\Core\Attributes\Optional;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Bridge-backed account type that can be shown in add-account flows.
 *
 * @phpstan-import-type AccountShape from \BeeperDesktop\Accounts\Account
 * @phpstan-import-type BridgeShape from \BeeperDesktop\Bridges\BridgeAvailability\Bridge
 *
 * @phpstan-type BridgeAvailabilityShape = array{
 *   accounts: list<Account|AccountShape>,
 *   activeAccountCount: int,
 *   bridge: Bridge|BridgeShape,
 *   displayName: string,
 *   loginMode: string,
 *   status: Status|value-of<Status>,
 *   network?: string|null,
 *   statusText?: string|null,
 * }
 */
final class BridgeAvailability implements BaseModel
{
    /** @use SdkModel<BridgeAvailabilityShape> */
    use SdkModel;

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
     * Bridge metadata for the account. Available in Beeper Desktop v4.2.785+.
     */
    #[Required]
    public Bridge $bridge;

    /**
     * Human-friendly account type name shown in Beeper Desktop.
     */
    #[Required]
    public string $displayName;

    /**
     * Login mode used by Beeper Desktop for this bridge.
     */
    #[Required]
    public string $loginMode;

    /**
     * Whether this bridge can currently be used to add an account.
     *
     * @var value-of<Status> $status
     */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * Network grouping used for account counts and limits.
     */
    #[Optional]
    public ?string $network;

    /**
     * Human-friendly status text matching Beeper Desktop account management language.
     */
    #[Optional]
    public ?string $statusText;

    /**
     * `new BridgeAvailability()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BridgeAvailability::with(
     *   accounts: ...,
     *   activeAccountCount: ...,
     *   bridge: ...,
     *   displayName: ...,
     *   loginMode: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BridgeAvailability)
     *   ->withAccounts(...)
     *   ->withActiveAccountCount(...)
     *   ->withBridge(...)
     *   ->withDisplayName(...)
     *   ->withLoginMode(...)
     *   ->withStatus(...)
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
     * @param Bridge|BridgeShape $bridge
     * @param Status|value-of<Status> $status
     */
    public static function with(
        array $accounts,
        int $activeAccountCount,
        Bridge|array $bridge,
        string $displayName,
        string $loginMode,
        Status|string $status,
        ?string $network = null,
        ?string $statusText = null,
    ): self {
        $self = new self;

        $self['accounts'] = $accounts;
        $self['activeAccountCount'] = $activeAccountCount;
        $self['bridge'] = $bridge;
        $self['displayName'] = $displayName;
        $self['loginMode'] = $loginMode;
        $self['status'] = $status;

        null !== $network && $self['network'] = $network;
        null !== $statusText && $self['statusText'] = $statusText;

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
     * Bridge metadata for the account. Available in Beeper Desktop v4.2.785+.
     *
     * @param Bridge|BridgeShape $bridge
     */
    public function withBridge(Bridge|array $bridge): self
    {
        $self = clone $this;
        $self['bridge'] = $bridge;

        return $self;
    }

    /**
     * Human-friendly account type name shown in Beeper Desktop.
     */
    public function withDisplayName(string $displayName): self
    {
        $self = clone $this;
        $self['displayName'] = $displayName;

        return $self;
    }

    /**
     * Login mode used by Beeper Desktop for this bridge.
     */
    public function withLoginMode(string $loginMode): self
    {
        $self = clone $this;
        $self['loginMode'] = $loginMode;

        return $self;
    }

    /**
     * Whether this bridge can currently be used to add an account.
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
     * Network grouping used for account counts and limits.
     */
    public function withNetwork(string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * Human-friendly status text matching Beeper Desktop account management language.
     */
    public function withStatusText(string $statusText): self
    {
        $self = clone $this;
        $self['statusText'] = $statusText;

        return $self;
    }
}
