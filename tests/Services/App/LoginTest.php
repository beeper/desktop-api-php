<?php

namespace Tests\Services\App;

use BeeperDesktop\App\Login\LoginRegisterResponse;
use BeeperDesktop\App\Login\LoginStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LoginTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(accessToken: 'My Access Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testEmail(): void
    {
        $result = $this->client->app->login->email(
            email: 'dev@stainless.com',
            setupRequestID: 'setupRequestID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testEmailWithOptionalParams(): void
    {
        $result = $this->client->app->login->email(
            email: 'dev@stainless.com',
            setupRequestID: 'setupRequestID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRegister(): void
    {
        $result = $this->client->app->login->register(
            leadToken: 'leadToken',
            setupRequestID: 'setupRequestID',
            username: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginRegisterResponse::class, $result);
    }

    #[Test]
    public function testRegisterWithOptionalParams(): void
    {
        $result = $this->client->app->login->register(
            acceptTerms: true,
            leadToken: 'leadToken',
            setupRequestID: 'setupRequestID',
            username: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginRegisterResponse::class, $result);
    }

    #[Test]
    public function testResponse(): void
    {
        $result = $this->client->app->login->response(
            response: 'response',
            setupRequestID: 'setupRequestID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testResponseWithOptionalParams(): void
    {
        $result = $this->client->app->login->response(
            response: 'response',
            setupRequestID: 'setupRequestID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testStart(): void
    {
        $result = $this->client->app->login->start();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginStartResponse::class, $result);
    }
}
