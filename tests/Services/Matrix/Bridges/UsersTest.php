<?php

namespace Tests\Services\Matrix\Bridges;

use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\Matrix\Bridges\Users\UserResolveResponse;
use BeeperDesktop\Matrix\Bridges\Users\UserSearchResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class UsersTest extends TestCase
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
    public function testResolve(): void
    {
        $result = $this->client->matrix->bridges->users->resolve(
            'identifier',
            bridgeID: 'bridgeID'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UserResolveResponse::class, $result);
    }

    #[Test]
    public function testResolveWithOptionalParams(): void
    {
        $result = $this->client->matrix->bridges->users->resolve(
            'identifier',
            bridgeID: 'bridgeID',
            loginID: 'bcc68892-b180-414f-9516-b4aadf7d0496',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UserResolveResponse::class, $result);
    }

    #[Test]
    public function testSearch(): void
    {
        $result = $this->client->matrix->bridges->users->search('bridgeID');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(UserSearchResponse::class, $result);
    }
}
