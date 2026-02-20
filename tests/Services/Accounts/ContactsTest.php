<?php

namespace Tests\Services\Accounts;

use BeeperDesktop\Accounts\Contacts\ContactSearchResponse;
use BeeperDesktop\Client;
use BeeperDesktop\Core\Util;
use BeeperDesktop\CursorSearch;
use BeeperDesktop\User;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
#[CoversNothing]
final class ContactsTest extends TestCase
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
    public function testList(): void
    {
        $page = $this->client->accounts->contacts->list('accountID');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(CursorSearch::class, $page);

        if ($item = $page->getItems()[0] ?? null) {
            // @phpstan-ignore-next-line method.alreadyNarrowedType
            $this->assertInstanceOf(User::class, $item);
        }
    }

    #[Test]
    public function testSearch(): void
    {
        $result = $this->client->accounts->contacts->search(
            'accountID',
            query: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ContactSearchResponse::class, $result);
    }

    #[Test]
    public function testSearchWithOptionalParams(): void
    {
        $result = $this->client->accounts->contacts->search(
            'accountID',
            query: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ContactSearchResponse::class, $result);
    }
}
