<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Chats;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\Chats\MessagesRawContract;

/**
 * Manage chat messages.
 */
final class MessagesRawService implements MessagesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
