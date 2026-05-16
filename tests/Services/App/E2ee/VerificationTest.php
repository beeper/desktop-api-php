<?php

namespace Tests\Services\App\E2ee;

use BeeperDesktop\App\E2ee\Verification\VerificationAcceptResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationCancelResponse;
use BeeperDesktop\App\E2ee\Verification\VerificationNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class VerificationTest extends TestCase
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
        $result = $this->client->app->e2ee->verification->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationNewResponse::class, $result);
    }

    #[Test]
    public function testAccept(): void
    {
        $result = $this->client->app->e2ee->verification->accept('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationAcceptResponse::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->app->e2ee->verification->cancel('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationCancelResponse::class, $result);
    }
}
