<?php

namespace Tests\Services\Matrix\Rooms;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Rooms\Events\EventGetResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class EventsTest extends TestCase
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
    public function testRetrieve(): void
    {
        $result = $this->client->matrix->rooms->events->retrieve(
            '$asfDuShaf7Gafaw:matrix.org',
            roomID: '!636q39766251:matrix.org'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EventGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        $result = $this->client->matrix->rooms->events->retrieve(
            '$asfDuShaf7Gafaw:matrix.org',
            roomID: '!636q39766251:matrix.org'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(EventGetResponse::class, $result);
    }
}
