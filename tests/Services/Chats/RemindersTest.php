<?php

namespace Tests\Services\Chats;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(accessToken: 'My Access Token', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testCreate(): void
    {
        $result = $this->client->chats->reminders->create(
            '!NCdzlIaMjZUmvmvyHU:beeper.com',
            reminder: ['remindAtMs' => 0]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        $result = $this->client->chats->reminders->create(
            '!NCdzlIaMjZUmvmvyHU:beeper.com',
            reminder: ['remindAtMs' => 0, 'dismissOnIncomingMessage' => true],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testDelete(): void
    {
        $result = $this->client->chats->reminders->delete(
            '!NCdzlIaMjZUmvmvyHU:beeper.com'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
