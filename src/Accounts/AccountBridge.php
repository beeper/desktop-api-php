<?php

declare(strict_types=1);

namespace BeeperDesktop\Accounts;

use BeeperDesktop\Accounts\AccountBridge\Provider;
use BeeperDesktop\Core\Attributes\Required;
use BeeperDesktop\Core\Concerns\SdkModel;
use BeeperDesktop\Core\Contracts\BaseModel;

/**
 * Bridge metadata for the account. Available in Beeper Desktop v4.2.785+.
 *
 * @phpstan-type AccountBridgeShape = array{
 *   id: string, provider: Provider|value-of<Provider>, type: string
 * }
 */
final class AccountBridge implements BaseModel
{
    /** @use SdkModel<AccountBridgeShape> */
    use SdkModel;

    /**
     * Bridge identifier. Beeper Cloud accounts often use the network type (for example matrix or discordgo); on-device accounts use a local bridge ID (for example local-whatsapp). Available in Beeper Desktop v4.2.785+.
     */
    #[Required]
    public string $id;

    /**
     * Where this account runs: on this device or in Beeper Cloud. Available in Beeper Desktop v4.2.785+.
     *
     * @var value-of<Provider> $provider
     */
    #[Required(enum: Provider::class)]
    public string $provider;

    /**
     * Bridge type, such as matrix, discordgo, slackgo, whatsapp, telegram, or twitter. Available in Beeper Desktop v4.2.785+.
     */
    #[Required]
    public string $type;

    /**
     * `new AccountBridge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AccountBridge::with(id: ..., provider: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AccountBridge)->withID(...)->withProvider(...)->withType(...)
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
     * @param Provider|value-of<Provider> $provider
     */
    public static function with(
        string $id,
        Provider|string $provider,
        string $type
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['provider'] = $provider;
        $self['type'] = $type;

        return $self;
    }

    /**
     * Bridge identifier. Beeper Cloud accounts often use the network type (for example matrix or discordgo); on-device accounts use a local bridge ID (for example local-whatsapp). Available in Beeper Desktop v4.2.785+.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Where this account runs: on this device or in Beeper Cloud. Available in Beeper Desktop v4.2.785+.
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
     * Bridge type, such as matrix, discordgo, slackgo, whatsapp, telegram, or twitter. Available in Beeper Desktop v4.2.785+.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
