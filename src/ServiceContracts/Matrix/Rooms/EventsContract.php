<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Rooms;

use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\Events\EventGetResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface EventsContract
{
    /**
     * @api
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
    ): EventGetResponse;
}
