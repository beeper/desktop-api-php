<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\App\Setup;

use BeeperDesktop\App\Setup\RecoveryKey\RecoveryKeyVerifyResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\App\Setup\RecoveryKeyContract;
use BeeperDesktop\Services\App\Setup\RecoveryKey\ResetService;

/**
 * Manage recovery-key setup for encrypted messages.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class RecoveryKeyService implements RecoveryKeyContract
{
    /**
     * @api
     */
    public RecoveryKeyRawService $raw;

    /**
     * @api
     */
    public ResetService $reset;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RecoveryKeyRawService($client);
        $this->reset = new ResetService($client);
    }

    /**
     * @api
     *
     * Unlock encrypted messages with the user recovery key.
     *
     * @param string $recoveryKey recovery key saved by the user
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        string $recoveryKey,
        RequestOptions|array|null $requestOptions = null
    ): RecoveryKeyVerifyResponse {
        $params = Util::removeNulls(['recoveryKey' => $recoveryKey]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->verify(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
