<?php

namespace Tests\Services\App;

use BeeperDesktop\App\Setup\SetupGetResponse;
use BeeperDesktop\App\Setup\SetupRegisterResponse;
use BeeperDesktop\App\Setup\SetupStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class SetupTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->app->setup->retrieve();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SetupGetResponse::class, $result);
    }

    #[Test]
    public function testEmail(): void
    {
        $result = $this->client->app->setup->email(
            email: 'dev@stainless.com',
            setupRequestID: 'setupRequestID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testEmailWithOptionalParams(): void
    {
        $result = $this->client->app->setup->email(
            email: 'dev@stainless.com',
            setupRequestID: 'setupRequestID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testRegister(): void
    {
        $result = $this->client->app->setup->register(
            leadToken: 'leadToken',
            setupRequestID: 'setupRequestID',
            username: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SetupRegisterResponse::class, $result);
    }

    #[Test]
    public function testRegisterWithOptionalParams(): void
    {
        $result = $this->client->app->setup->register(
            acceptTerms: true,
            leadToken: 'leadToken',
            setupRequestID: 'setupRequestID',
            username: 'x',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SetupRegisterResponse::class, $result);
    }

    #[Test]
    public function testResponse(): void
    {
        $result = $this->client->app->setup->response(
            response: 'response',
            setupRequestID: 'setupRequestID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testResponseWithOptionalParams(): void
    {
        $result = $this->client->app->setup->response(
            response: 'response',
            setupRequestID: 'setupRequestID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testStart(): void
    {
        $result = $this->client->app->setup->start();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SetupStartResponse::class, $result);
    }
}
