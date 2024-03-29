<?php

namespace Feature\Api;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticlesTest extends WebTestCase
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testArticle(): void
    {
        $client = new Client(
            [
                'base_uri' => APP_INNER_URL,
            ]
        );

        $response = $client->get('/api/article/zamok-hruba-skala-chexiya');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testArticles(): void
    {
        $client = new Client(
            [
                'base_uri' => APP_INNER_URL,
            ]
        );

        $response = $client->get('/api/articles');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
