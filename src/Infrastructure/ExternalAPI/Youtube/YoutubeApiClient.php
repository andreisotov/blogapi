<?php
namespace BlogAPI\Infrastructure\ExternalAPI\Youtube;

use Google_Client;
use Google_Service_YouTube;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

trait YoutubeApiClient
{
    public function __construct(
        private ContainerBagInterface $params
    ) {
    }

    private function youtubeClient(): Google_Service_YouTube
    {
        $client = new Google_Client();
        $client->setDeveloperKey($this->params->get('google_api.key'));

        return new Google_Service_YouTube($client);
    }
}
