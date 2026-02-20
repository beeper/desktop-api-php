<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Info\InfoGetResponse;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\InfoContract;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class InfoService implements InfoContract
{
    /**
     * @api
     */
    public InfoRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InfoRawService($client);
    }

    /**
     * @api
     *
     * Returns app, platform, server, and endpoint discovery metadata for this Beeper Desktop instance.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        RequestOptions|array|null $requestOptions = null
    ): InfoGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve(requestOptions: $requestOptions);

        return $response->parse();
    }
}
