<?php

namespace Tests\Services\Bridges;

use BeeperDesktop\Bridges\BridgeLogin;
use BeeperDesktop\Bridges\Logins\LoginListResponse;
use BeeperDesktop\Bridges\Logins\LoginRemoveResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class LoginsTest extends TestCase
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
        $result = $this->client->bridges->logins->retrieve(
            'ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc',
            bridgeID: 'local-whatsapp'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BridgeLogin::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->bridges->logins->retrieve(
            'ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc',
            bridgeID: 'local-whatsapp'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BridgeLogin::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->bridges->logins->list('local-whatsapp');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginListResponse::class, $result);
    }

    #[Test]
    public function testRemove(): void
    {
        $result = $this->client->bridges->logins->remove(
            'ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc',
            bridgeID: 'local-whatsapp',
            scope: 'current-device',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginRemoveResponse::class, $result);
    }

    #[Test]
    public function testRemoveWithOptionalParams(): void
    {
        $result = $this->client->bridges->logins->remove(
            'ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc',
            bridgeID: 'local-whatsapp',
            scope: 'current-device',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginRemoveResponse::class, $result);
    }
}
