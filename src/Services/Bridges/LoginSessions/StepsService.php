<?php

declare(strict_types=1);

namespace BeeperDesktop\Services\Bridges\LoginSessions;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams\Source;
use BeeperDesktop\Bridges\LoginSessions\Steps\StepSubmitParams\Type;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Util;
use BeeperDesktop\RequestOptions;
use BeeperDesktop\ServiceContracts\Bridges\LoginSessions\StepsContract;

/**
 * Available bridges, bridge logins, login sessions for connect and reconnect flows, and advanced network capabilities.
 *
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
final class StepsService implements StepsContract
{
    /**
     * @api
     */
    public StepsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new StepsRawService($client);
    }

    /**
     * @api
     *
     * Submit input for the current step of a bridge login session.
     *
     * @param string $stepID path param: Current bridge login session step ID
     * @param string $bridgeID path param: Bridge ID
     * @param string $loginSessionID path param: Temporary bridge login session ID
     * @param Type|value-of<Type> $type Body param
     * @param array<string,string> $fields body param: Field values keyed by the field IDs from the current step
     * @param string $lastURL body param: Last browser URL reached during a cookies step, if available
     * @param Source|value-of<Source> $source Body param: How the step was completed. Omit unless the client needs to distinguish an embedded webview or browser extension.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function submit(
        string $stepID,
        string $bridgeID,
        string $loginSessionID,
        Type|string $type,
        ?array $fields = null,
        ?string $lastURL = null,
        Source|string|null $source = null,
        RequestOptions|array|null $requestOptions = null,
    ): LoginSession {
        $params = Util::removeNulls(
            [
                'bridgeID' => $bridgeID,
                'loginSessionID' => $loginSessionID,
                'type' => $type,
                'fields' => $fields,
                'lastURL' => $lastURL,
                'source' => $source,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->submit($stepID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
