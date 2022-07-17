<?php

namespace Functional\Api;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoriesTest extends WebTestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCategory(): void
    {
        $client = new Client(
            [
                'base_uri' => 'http://127.0.0.1:8080',
            ]
        );

        $response = $client->get('/api/category/chto-posmotret-v-chexii');

        $this->assertEquals(200, $response->getStatusCode());
    }

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

        $response = $client->get('/api/categories');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
