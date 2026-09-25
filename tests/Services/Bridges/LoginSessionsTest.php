<?php

namespace Tests\Services\Bridges;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Bridges\LoginSessions\LoginSessionCancelResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LoginSessionsTest extends TestCase
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
    public function testCreate(): void
    {
        $result = $this->client->bridges->loginSessions->create('local-whatsapp');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginSession::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->bridges->loginSessions->retrieve(
            '123',
            bridgeID: 'local-whatsapp'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginSession::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->bridges->loginSessions->retrieve(
            '123',
            bridgeID: 'local-whatsapp'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginSession::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->bridges->loginSessions->cancel(
            '123',
            bridgeID: 'local-whatsapp'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginSessionCancelResponse::class, $result);
    }

    #[Test]
    public function testCancelWithOptionalParams(): void
    {
        $result = $this->client->bridges->loginSessions->cancel(
            '123',
            bridgeID: 'local-whatsapp'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginSessionCancelResponse::class, $result);
    }
}
