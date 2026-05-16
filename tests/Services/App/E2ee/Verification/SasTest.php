<?php

namespace Tests\Services\App\E2ee\Verification;

use BeeperDesktop\App\E2ee\Verification\Sas\SaConfirmResponse;
use BeeperDesktop\App\E2ee\Verification\Sas\SaStartResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class SasTest extends TestCase
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
    public function testConfirm(): void
    {
        $result = $this->client->app->e2ee->verification->sas->confirm('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SaConfirmResponse::class, $result);
    }

    #[Test]
    public function testStart(): void
    {
        $result = $this->client->app->e2ee->verification->sas->start('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SaStartResponse::class, $result);
    }
}
