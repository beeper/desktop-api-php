<?php

namespace Tests\Services\Matrix;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Rooms\RoomJoinResponse;
use BeeperDesktop\Matrix\Rooms\RoomNewResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class RoomsTest extends TestCase
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
        $result = $this->client->matrix->rooms->create();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoomNewResponse::class, $result);
    }

    #[Test]
    public function testJoin(): void
    {
        $result = $this->client->matrix->rooms->join('!monkeys:matrix.org');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoomJoinResponse::class, $result);
    }

    #[Test]
    public function testLeave(): void
    {
        $result = $this->client->matrix->rooms->leave('!nkl290a:matrix.org');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsNotResource($result);
    }
}
