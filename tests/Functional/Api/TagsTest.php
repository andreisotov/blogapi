<?php

namespace Functional\Api;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagsTest extends WebTestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCategories(): void
    {
        $client = new Client(
            [
                'base_uri' => 'http://127.0.0.1:8080',
            ]
        );

        $response = $client->get('/api/tags');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
