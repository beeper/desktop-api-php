<?php

namespace Tests\Services\App\Login\Verification;

use BeeperDesktop\App\Login\Verification\RecoveryKey\RecoveryKeyVerifyResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RecoveryKeyTest extends TestCase
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
    public function testVerify(): void
    {
        $result = $this->client->app->login->verification->recoveryKey->verify(
            recoveryKey: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RecoveryKeyVerifyResponse::class, $result);
    }

    #[Test]
    public function testVerifyWithOptionalParams(): void
    {
        $result = $this->client->app->login->verification->recoveryKey->verify(
            recoveryKey: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RecoveryKeyVerifyResponse::class, $result);
    }
}
