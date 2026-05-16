<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceFocusResponse;
use BeeperDesktop\BeeperDesktopClientService\BeeperDesktopClientServiceSearchResponse;
use BeeperDesktop\Core\BaseClient;
use BeeperDesktop\Core\Exceptions\APIException;
use BeeperDesktop\Core\Implementation\StreamingHttpClient;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Services\AccountsService;
use BeeperDesktop\Services\AppService;
use BeeperDesktop\Services\AssetsService;
use BeeperDesktop\Services\BeeperDesktopClientRawService;
use BeeperDesktop\Services\BeeperDesktopClientService;
use BeeperDesktop\Services\BridgesService;
use BeeperDesktop\Services\ChatsService;
use BeeperDesktop\Services\InfoService;
use BeeperDesktop\Services\MatrixService;
use BeeperDesktop\Services\MessagesService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \BeeperDesktop\Core\BaseClient
 * @phpstan-import-type RequestOpts from \BeeperDesktop\RequestOptions
 */
class Client extends BaseClient
{
    public string $accessToken;

    /**
     * @api
     */
    public AccountsService $accounts;

    /**
     * @api
     */
    public BridgesService $bridges;

    /**
     * @api
     */
    public ChatsService $chats;

    /**
     * @api
     */
    public MessagesService $messages;

    /**
     * @api
     */
    public AssetsService $assets;

    /**
     * @api
     */
    public InfoService $info;

    /**
     * @api
     */
    public AppService $app;

    /**
     * @api
     */
    public MatrixService $matrix;

    /**
     * @api
     */
    public BeeperDesktopClientRawService $raw;

    /**
     * @api
     */
    private BeeperDesktopClientService $beeperDesktopClientService;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $accessToken = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->accessToken = (string) ($accessToken ?? Util::getenv(
            'BEEPER_ACCESS_TOKEN'
        ));

        $baseUrl ??= Util::getenv('BEEPER_BASE_URL') ?: 'http://localhost:23373';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        if (is_null($options->streamingTransporter)) {
            assert(!is_null($options->transporter));
            $options->streamingTransporter = new StreamingHttpClient($options->transporter);
        }

        /** @var array<string, string|null> $headers */
        $headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'User-Agent' => sprintf('beeperdesktop/PHP %s', VERSION),
            'X-Stainless-Lang' => 'php',
            'X-Stainless-Package-Version' => '0.0.1',
            'X-Stainless-Arch' => Util::machtype(),
            'X-Stainless-OS' => Util::ostype(),
            'X-Stainless-Runtime' => php_sapi_name(),
            'X-Stainless-Runtime-Version' => phpversion(),
        ];

        $customHeadersEnv = Util::getenv('BEEPER_CUSTOM_HEADERS');
        if (null !== $customHeadersEnv) {
            foreach (explode("\n", $customHeadersEnv) as $line) {
                $colon = strpos($line, ':');
                if (false !== $colon) {
                    $headers[trim(substr($line, 0, $colon))] = trim(substr($line, $colon + 1));
                }
            }
        }

        parent::__construct(
            headers: $headers,
            baseUrl: $baseUrl,
            options: $options
        );

        $this->accounts = new AccountsService($this);
        $this->bridges = new BridgesService($this);
        $this->chats = new ChatsService($this);
        $this->messages = new MessagesService($this);
        $this->assets = new AssetsService($this);
        $this->info = new InfoService($this);
        $this->app = new AppService($this);
        $this->matrix = new MatrixService($this);
        $this->raw = new BeeperDesktopClientRawService($this);
        $this->beeperDesktopClientService = new BeeperDesktopClientService($this);
    }

    /**
     * @api
     *
     * Focus Beeper Desktop and optionally navigate to a specific chat, message, or pre-fill plain text and an image path.
     *
     * @param string $chatID Optional Beeper chat ID (or local chat ID) to focus after opening the app. If omitted, only opens/focuses the app.
     * @param string $draftAttachmentPath optional image path to populate in the message input field
     * @param string $draftText optional plain text to populate in the message input field
     * @param string $messageID Optional message ID. Jumps to that message in the chat when opening.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function focus(
        ?string $chatID = null,
        ?string $draftAttachmentPath = null,
        ?string $draftText = null,
        ?string $messageID = null,
        RequestOptions|array|null $requestOptions = null,
    ): BeeperDesktopClientServiceFocusResponse {
        return $this->beeperDesktopClientService->focus(
            $chatID,
            $draftAttachmentPath,
            $draftText,
            $messageID,
            $requestOptions
        );
    }

    /**
     * @api
     *
     * Returns matching chats, participant name matches in groups, and the first page of messages in one call. Paginate messages via search-messages. Paginate chats via search-chats.
     *
     * @param string $query User-typed search text. Literal word matching (non-semantic).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function search(
        string $query,
        RequestOptions|array|null $requestOptions = null
    ): BeeperDesktopClientServiceSearchResponse {
        return $this->beeperDesktopClientService->search($query, $requestOptions);
    }

    /**
     * @param array{bearerAuth?: bool} $security
     *
     * @return array<string,string>
     */
    protected function authHeaders(array $security): array
    {
        return [...($security['bearerAuth'] ?? false) ? $this->bearerAuth() : []];
    }

    /** @return array<string,string> */
    protected function bearerAuth(): array
    {
        return $this->accessToken ? [
            'Authorization' => "Bearer {$this->accessToken}",
        ] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     * @param array{bearerAuth?: bool}|null $security
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
        ?array $security = null,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [
                ...$this->authHeaders(security: ($security ?? ['bearerAuth' => true])),
                ...$headers,
            ],
            body: $body,
            opts: $opts,
            security: $security,
        );
    }
}
