<?php
declare(strict_types=1);


namespace App\Tests\Integration\Domain\Poll;


use Coduo\PHPMatcher\PHPUnit\PHPMatcherAssertions;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class EntryAPITest extends WebTestCase
{
    use PHPMatcherAssertions;

    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient([]);
    }

    public function test_get_entries(): void
    {
        $this->client->request(
            Request::METHOD_GET,
            '/entries'
        );

        self::assertResponseIsSuccessful();
        $response = $this->client->getResponse()->getContent();
    }
}