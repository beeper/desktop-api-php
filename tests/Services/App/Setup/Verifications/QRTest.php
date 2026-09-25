<?php

namespace Tests\Services\App\Setup\Verifications;

use BeeperDesktop\App\Setup\Verifications\QR\QRConfirmScannedResponse;
use BeeperDesktop\App\Setup\Verifications\QR\QRScanResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class QRTest extends TestCase
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
    public function testConfirmScanned(): void
    {
        $result = $this->client->app->setup->verifications->qr->confirmScanned('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(QRConfirmScannedResponse::class, $result);
    }

    #[Test]
    public function testScan(): void
    {
        $result = $this->client->app->setup->verifications->qr->scan(data: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(QRScanResponse::class, $result);
    }

    #[Test]
    public function testScanWithOptionalParams(): void
    {
        $result = $this->client->app->setup->verifications->qr->scan(data: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(QRScanResponse::class, $result);
    }
}
