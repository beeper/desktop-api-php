<?php

declare(strict_types=1);

namespace BeeperDesktop\ServiceContracts\Bridges\LoginSessions;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams;
use BeeperDesktop\Core\Contracts\BaseResponse;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
interface StepsRawContract
{
    /**
     * @api
     *
     * @param string $stepID path param: Current bridge login session step ID
     * @param array<string,mixed>|StepSubmitParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<LoginSession>
     *
     * @throws APIException
     */
    public function submit(
        string $stepID,
        array|StepSubmitParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
