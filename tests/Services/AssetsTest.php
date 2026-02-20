<?php

namespace Tests\Services;

use BeeperDesktop\Assets\AssetDownloadResponse;
use BeeperDesktop\Assets\AssetUploadBase64Response;
use BeeperDesktop\Assets\AssetUploadResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class AssetsTest extends TestCase
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
    public function testDownload(): void
    {
        $result = $this->client->assets->download(
            url: 'mxc://example.org/Q4x9CqGz1pB3Oa6XgJ'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetDownloadResponse::class, $result);
    }

    #[Test]
    public function testDownloadWithOptionalParams(): void
    {
        $result = $this->client->assets->download(
            url: 'mxc://example.org/Q4x9CqGz1pB3Oa6XgJ'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetDownloadResponse::class, $result);
    }

    #[Test]
    public function testServe(): void
    {
        $result = $this->client->assets->serve(url: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testServeWithOptionalParams(): void
    {
        $result = $this->client->assets->serve(url: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpload(): void
    {
        $result = $this->client->assets->upload(file: 'file');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetUploadResponse::class, $result);
    }

    #[Test]
    public function testUploadWithOptionalParams(): void
    {
        $result = $this->client->assets->upload(
            file: 'file',
            fileName: 'fileName',
            mimeType: 'mimeType'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetUploadResponse::class, $result);
    }

    #[Test]
    public function testUploadBase64(): void
    {
        $result = $this->client->assets->uploadBase64(content: 'x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetUploadBase64Response::class, $result);
    }

    #[Test]
    public function testUploadBase64WithOptionalParams(): void
    {
        $result = $this->client->assets->uploadBase64(
            content: 'x',
            fileName: 'fileName',
            mimeType: 'mimeType'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssetUploadBase64Response::class, $result);
    }
}
