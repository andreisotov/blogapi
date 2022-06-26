<?php

namespace BlogAPI\Infrastructure\Services;

use BlogAPI\Infrastructure\ExternalAPI\Youtube\YoutubeVideo;
use BlogAPI\Infrastructure\Services\Interfaces\FetchServiceInterface;

class FetchYoutubeVideoService implements FetchServiceInterface
{
    public function __construct(
        private YoutubeVideo $provider
    ) {
    }

    public function fetch(array $input): array|object
    {
        return $this->provider->getContent($input);
    }
}
