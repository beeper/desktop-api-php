<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Labels\Label;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\LabelsContract;

/**
 * User-created labels that organize chats.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LabelsService implements LabelsContract
{
    /**
     * @api
     */
    public LabelsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new LabelsRawService($client);
    }

    /**
     * @api
     *
     * List the labels the user has created for organizing chats. Filter chats by label via GET /v1/chats/search with labelID.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<Label>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }
}
