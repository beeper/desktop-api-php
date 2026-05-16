<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Rooms;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\State\StateListResponseItem;
use BeeperDesktop\Matrix\Rooms\State\StateRetrieveParams\Format;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface StateContract
{
    /**
     * @api
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
    ): array;

    /**
     * @api
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
    ): array;
}
