<?php

namespace Tests\Services\Bridges\LoginSessions;

use BeeperDesktop\Bridges\LoginSession;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class StepsTest extends TestCase
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
    public function testSubmit(): void
    {
        $result = $this->client->bridges->loginSessions->steps->submit(
            'x',
            bridgeID: 'local-whatsapp',
            loginSessionID: '123',
            type: 'user_input'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginSession::class, $result);
    }

    #[Test]
    public function testSubmitWithOptionalParams(): void
    {
        $result = $this->client->bridges->loginSessions->steps->submit(
            'x',
            bridgeID: 'local-whatsapp',
            loginSessionID: '123',
            type: 'user_input',
            fields: ['foo' => 'string'],
            lastURL: 'lastURL',
            source: 'api',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(LoginSession::class, $result);
    }
}
