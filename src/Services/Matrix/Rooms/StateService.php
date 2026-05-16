<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Rooms;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Rooms\State\StateListResponseItem;
use BeeperDesktop\Matrix\Rooms\State\StateRetrieveParams\Format;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Rooms\StateContract;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class StateService implements StateContract
{
    /**
     * @api
     */
    public StateRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new StateRawService($client);
    }

    /**
     * @api
     *
     * Looks up the contents of a state event in a room. If the user is
     * joined to the room then the state is taken from the current
     * state of the room. If the user has left the room then the state is
     * taken from the state of the room when they left.
     *
     * @param string $stateKey Path param: The key of the state to look up. Defaults to an empty string. When
     * an empty string, the trailing slash on this endpoint is optional.
     * @param string $roomID path param: The room to look up the state in
     * @param string $eventType path param: The type of state to look up
     * @param Format|value-of<Format> $format Query param: The format to use for the returned data. `content` (the default) will
     * return only the content of the state event. `event` will return the entire
     * event in the usual format suitable for clients, including fields like event
     * ID, sender and timestamp.
     * @param RequestOpts|null $requestOptions
     *
     * @return array<string,mixed>
     *
     * @throws APIException
     */
    public function retrieve(
        string $stateKey,
        string $roomID,
        string $eventType,
        Format|string|null $format = null,
        RequestOptions|array|null $requestOptions = null,
    ): array {
        $params = Util::removeNulls(
            ['roomID' => $roomID, 'eventType' => $eventType, 'format' => $format]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($stateKey, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the state events for the current state of a room.
     *
     * @param string $roomID the room to look up the state for
     * @param RequestOpts|null $requestOptions
     *
     * @return list<StateListResponseItem>
     *
     * @throws APIException
     */
    public function list(
        string $roomID,
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($roomID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
