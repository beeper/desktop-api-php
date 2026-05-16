<?php

namespace Tests\Services\App\E2ee;

use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeMarkBackedUpResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\RecoveryCodeVerifyResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RecoveryCodeTest extends TestCase
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
    public function testMarkBackedUp(): void
    {
        $result = $this->client->app->e2ee->recoveryCode->markBackedUp();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RecoveryCodeMarkBackedUpResponse::class, $result);
    }

    #[Test]
    public function testVerify(): void
    {
        $result = $this->client->app->e2ee->recoveryCode->verify(recoveryCode: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RecoveryCodeVerifyResponse::class, $result);
    }

    #[Test]
    public function testVerifyWithOptionalParams(): void
    {
        $result = $this->client->app->e2ee->recoveryCode->verify(recoveryCode: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RecoveryCodeVerifyResponse::class, $result);
    }
}
