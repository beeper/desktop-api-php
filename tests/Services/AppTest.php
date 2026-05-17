<?php

namespace Tests\Services;

use BeeperDesktop\App\AppSessionResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class AppTest extends TestCase
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
    public function testSession(): void
    {
        $result = $this->client->app->session();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AppSessionResponse::class, $result);
    }
}
