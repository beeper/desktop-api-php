<?php

namespace Tests\Services\Chats\Messages;

use BeeperDesktop\Chats\Messages\Reactions\ReactionAddResponse;
use BeeperDesktop\Chats\Messages\Reactions\ReactionDeleteResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ReactionsTest extends TestCase
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
    public function testDelete(): void
    {
        $result = $this->client->chats->messages->reactions->delete(
            'x',
            chatID: '!NCdzlIaMjZUmvmvyHU:beeper.com',
            messageID: '1343993'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReactionDeleteResponse::class, $result);
    }

    #[Test]
    public function testDeleteWithOptionalParams(): void
    {
        $result = $this->client->chats->messages->reactions->delete(
            'x',
            chatID: '!NCdzlIaMjZUmvmvyHU:beeper.com',
            messageID: '1343993'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReactionDeleteResponse::class, $result);
    }

    #[Test]
    public function testAdd(): void
    {
        $result = $this->client->chats->messages->reactions->add(
            '1343993',
            chatID: '!NCdzlIaMjZUmvmvyHU:beeper.com',
            reactionKey: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReactionAddResponse::class, $result);
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        $result = $this->client->chats->messages->reactions->add(
            '1343993',
            chatID: '!NCdzlIaMjZUmvmvyHU:beeper.com',
            reactionKey: 'x',
            transactionID: 'transactionID',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ReactionAddResponse::class, $result);
    }
}
