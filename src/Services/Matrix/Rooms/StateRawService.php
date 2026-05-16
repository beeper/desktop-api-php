<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Rooms;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Conversion\ListOf;
use BeeperDesktop\Core\Conversion\MapOf;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\State\StateListResponseItem;
use BeeperDesktop\Matrix\Rooms\State\StateRetrieveParams;
use BeeperDesktop\Matrix\Rooms\State\StateRetrieveParams\Format;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Rooms\StateRawContract;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class StateRawService implements StateRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

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
     * @param array{
     *   roomID: string, eventType: string, format?: Format|value-of<Format>
     * }|StateRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function retrieve(
        string $stateKey,
        array|StateRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = StateRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $roomID = $parsed['roomID'];
        unset($parsed['roomID']);
        $eventType = $parsed['eventType'];
        unset($parsed['eventType']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                '_matrix/client/v3/rooms/%1$s/state/%2$s/%3$s',
                $roomID,
                $eventType,
                $stateKey,
            ],
            query: $parsed,
            options: $options,
            convert: new MapOf('mixed'),
        );
    }

    /**
     * @api
     *
     * Get the state events for the current state of a room.
     *
     * @param string $roomID the room to look up the state for
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<StateListResponseItem>>
     *
     * @throws APIException
     */
    public function list(
        string $roomID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['_matrix/client/v3/rooms/%1$s/state', $roomID],
            options: $requestOptions,
            convert: new ListOf(StateListResponseItem::class),
        );
    }
}
