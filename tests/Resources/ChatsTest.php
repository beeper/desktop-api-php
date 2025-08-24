<?php

namespace Tests\Resources;

use BeeperDesktop\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ChatsTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->chats->retrieve(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->chats->retrieve(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testArchive(): void
    {
        $result = $this->client->chats->archive(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testArchiveWithOptionalParams(): void
    {
        $result = $this->client->chats->archive(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testFind(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->chats->find();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testGetLink(): void
    {
        $result = $this->client->chats->getLink(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testGetLinkWithOptionalParams(): void
    {
        $result = $this->client->chats->getLink(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
