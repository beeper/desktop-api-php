<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Chats;

use BeeperDesktop\Client;
use BeeperDesktop\ServiceContracts\Chats\MessagesContract;
use BeeperDesktop\Services\Chats\Messages\ReactionsService;

/**
 * Manage chat messages.
 */
final class MessagesService implements MessagesContract
{
    /**
     * @api
     */
    public MessagesRawService $raw;

    /**
     * @api
     */
    public ReactionsService $reactions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MessagesRawService($client);
        $this->reactions = new ReactionsService($client);
    }
}
