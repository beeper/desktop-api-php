<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Conversion\MapOf;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Matrix\Bridges\CapabilitiesRawContract;

/**
 * Matrix-compatible APIs for accounts and connected network bridges.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class CapabilitiesRawService implements CapabilitiesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get bridge capabilities
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<array<string,mixed>>
     *
     * @throws APIException
     */
    public function retrieve(
        string $bridgeID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                '_matrix/client/unstable/com.beeper.bridge/%1$s/_matrix/provision/v3/capabilities',
                $bridgeID,
            ],
            options: $requestOptions,
            convert: new MapOf('mixed'),
        );
    }
}
