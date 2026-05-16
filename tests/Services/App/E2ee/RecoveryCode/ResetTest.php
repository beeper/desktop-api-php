<?php

namespace Tests\Services\App\E2ee\RecoveryCode;

use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetConfirmResponse;
use BeeperDesktop\App\E2ee\RecoveryCode\Reset\ResetNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ResetTest extends TestCase
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
        $result = $this->client->app->e2ee->recoveryCode->reset->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ResetNewResponse::class, $result);
    }

    #[Test]
    public function testConfirm(): void
    {
        $result = $this->client->app->e2ee->recoveryCode->reset->confirm(
            recoveryCode: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ResetConfirmResponse::class, $result);
    }

    #[Test]
    public function testConfirmWithOptionalParams(): void
    {
        $result = $this->client->app->e2ee->recoveryCode->reset->confirm(
            recoveryCode: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ResetConfirmResponse::class, $result);
    }
}
