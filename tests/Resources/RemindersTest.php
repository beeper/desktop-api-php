<?php

namespace Tests\Resources;

use BeeperDesktop\Client;
use BeeperDesktop\Reminders\ReminderSetParams\Reminder;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RemindersTest extends TestCase
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
    public function testClear(): void
    {
        $result = $this->client->reminders->clear(
            '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testClearWithOptionalParams(): void
    {
        $result = $this->client->reminders->clear(
            '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testSet(): void
    {
        $result = $this->client->reminders->set(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
            reminder: Reminder::with(remindAtMs: 0),
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }

    #[Test]
    public function testSetWithOptionalParams(): void
    {
        $result = $this->client->reminders->set(
            chatID: '!-5hI_iHR5vSDCtI8PzSDQT0H_3I:ba_EvYDBBsZbRQAy3UOSWqG0LuTVkc.local-whatsapp.localhost',
            reminder: Reminder::with(remindAtMs: 0)
                ->withDismissOnIncomingMessage(true),
        );

        $this->assertTrue(true); // @phpstan-ignore-line
    }
}
