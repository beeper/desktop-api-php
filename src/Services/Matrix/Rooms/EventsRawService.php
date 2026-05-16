<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Rooms;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\Events\EventGetResponse;
use BeeperDesktop\Matrix\Rooms\Events\EventRetrieveParams;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Rooms\EventsRawContract;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class EventsRawService implements EventsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get a single event based on `roomId/eventId`. You must have permission to
     * retrieve this event e.g. by being a member in the room for this event.
     *
     * @param string $eventID the event ID to get
     * @param array{roomID: string}|EventRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<EventGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $eventID,
        array|EventRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = EventRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $roomID = $parsed['roomID'];
        unset($parsed['roomID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['_matrix/client/v3/rooms/%1$s/event/%2$s', $roomID, $eventID],
            options: $options,
            convert: EventGetResponse::class,
        );
    }
}
