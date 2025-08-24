<?php

namespace Tests\Resources;

use BeeperDesktop\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class OAuthTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(accessToken: 'My Access Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testGetUserInfo(): void
    {
        $result = $this->client->oauth->getUserInfo();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRevokeToken(): void
    {
        $result = $this->client->oauth->revokeToken(token: 'token');

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRevokeTokenWithOptionalParams(): void
    {
        $result = $this->client->oauth->revokeToken(token: 'token');

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
