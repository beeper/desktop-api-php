<?php

namespace Tests\Services\App\Setup;

use BeeperDesktop\App\Setup\Verifications\VerificationAcceptResponse;
use BeeperDesktop\App\Setup\Verifications\VerificationCancelResponse;
use BeeperDesktop\App\Setup\Verifications\VerificationGetResponse;
use BeeperDesktop\App\Setup\Verifications\VerificationListResponse;
use BeeperDesktop\App\Setup\Verifications\VerificationNewResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class VerificationsTest extends TestCase
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
        $result = $this->client->app->setup->verifications->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationNewResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        $result = $this->client->app->setup->verifications->retrieve('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        $result = $this->client->app->setup->verifications->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationListResponse::class, $result);
    }

    #[Test]
    public function testAccept(): void
    {
        $result = $this->client->app->setup->verifications->accept('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationAcceptResponse::class, $result);
    }

    #[Test]
    public function testCancel(): void
    {
        $result = $this->client->app->setup->verifications->cancel('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(VerificationCancelResponse::class, $result);
    }
}
