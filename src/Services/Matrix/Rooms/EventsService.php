<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Rooms;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Rooms\Events\EventGetResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Rooms\EventsContract;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class EventsService implements EventsContract
{
    /**
     * @api
     */
    public EventsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new EventsRawService($client);
    }

    /**
     * @api
     *
     * Get a single event based on `roomId/eventId`. You must have permission to
     * retrieve this event e.g. by being a member in the room for this event.
     *
     * @param string $eventID the event ID to get
     * @param string $roomID the ID of the room the event is in
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        string $roomID,
        RequestOptions|array|null $requestOptions = null,
    ): EventGetResponse {
        $params = Util::removeNulls(['roomID' => $roomID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($eventID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
