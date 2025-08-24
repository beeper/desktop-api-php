<?php

declare(strict_types=1);

namespace BeeperDesktop;

use BeeperDesktop\Core\BaseClient;
use BeeperDesktop\Services\AccountsService;
use BeeperDesktop\Services\AppService;
use BeeperDesktop\Services\ChatsService;
use BeeperDesktop\Services\MessagesService;
use BeeperDesktop\Services\OAuthService;
use BeeperDesktop\Services\RemindersService;

class Client extends BaseClient
{
    public string $accessToken;

    public AccountsService $accounts;

    public AppService $app;

    public MessagesService $messages;

    public ChatsService $chats;

    public RemindersService $reminders;

    public OAuthService $oauth;

    public function __construct(?string $accessToken = null, ?string $baseUrl = null)
    {
        $this->accessToken = (string) (
            $accessToken ?? getenv('BEEPER_ACCESS_TOKEN')
        );

        $base = $baseUrl ?? getenv(
            'BEEPER-DESKTOP_BASE_URL'
        ) ?: 'http://localhost:23374';

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json', 'Accept' => 'application/json',
            ],
            baseUrl: $base,
            options: new RequestOptions,
        );

        $this->accounts = new AccountsService($this);
        $this->app = new AppService($this);
        $this->messages = new MessagesService($this);
        $this->chats = new ChatsService($this);
        $this->reminders = new RemindersService($this);
        $this->oauth = new OAuthService($this);
    }

    /** @return array<string, string> */
    protected function authHeaders(): array
    {
        return [...$this->bearerAuth(), ...$this->oauth2()];
    }

    /** @return array<string, string> */
    protected function bearerAuth(): array
    {
        if (!$this->accessToken) {
            return [];
        }

        return ['Authorization' => "Bearer {$this->accessToken}"];
    }

    /** @return array<string, string> */
    protected function oauth2(): array
    {
        throw new \BadMethodCallException;
    }
}
