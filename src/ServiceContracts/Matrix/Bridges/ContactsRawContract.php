<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Matrix\Bridges;

use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Matrix\Bridges\Contacts\ContactListParams;
use BeeperDesktop\Matrix\Bridges\Contacts\ContactListResponse;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface ContactsRawContract
{
    /**
     * @api
     *
     * @param string $bridgeID bridge ID for the connected network account, for example discordgo or local-whatsapp
     * @param array<string,mixed>|ContactListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ContactListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $bridgeID,
        array|ContactListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
