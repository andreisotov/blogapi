<?php

namespace Functional\Api;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticlesTest extends WebTestCase
{
    private const URL = 'http://127.0.0.1:8080';

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testArticle(): void
    {
        $client = new Client(
            [
                'base_uri' => self::URL,
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
                'base_uri' => self::URL,
            ]
        );

        $response = $client->get('/api/articles');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
