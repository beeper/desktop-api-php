<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Rooms;

use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Rooms\Events\EventGetResponse;
use BeeperDesktop\Matrix\Rooms\Events\EventRetrieveParams;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface EventsRawContract
{
    /**
     * @api
     *
     * @param string $eventID the event ID to get
     * @param array<string,mixed>|EventRetrieveParams $params
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
    ): BaseResponse;
}
