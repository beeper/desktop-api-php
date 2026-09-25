<?php

declare(strict_types=1);

namespace BeeperDesktop\Services;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Conversion\ListOf;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Labels\Label;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\LabelsRawContract;

/**
 * User-created labels that organize chats.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class LabelsRawService implements LabelsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * List the labels the user has created for organizing chats. Filter chats by label via GET /v1/chats/search with labelID.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<list<Label>>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'v1/labels',
            options: $requestOptions,
            convert: new ListOf(Label::class),
        );
    }
}
