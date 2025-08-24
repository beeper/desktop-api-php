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
final class MessagesTest extends TestCase
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
    public function testDraft(): void
    {
        $result = $this->client->messages->draft(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testDraftWithOptionalParams(): void
    {
        $result = $this->client->messages->draft(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testSearch(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('skipped: currently unsupported');
        }

        $result = $this->client->messages->search();

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testSend(): void
    {
        $result = $this->client->messages->send(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testSendWithOptionalParams(): void
    {
        $result = $this->client->messages->send(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
