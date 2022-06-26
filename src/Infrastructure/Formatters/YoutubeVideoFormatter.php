<?php

namespace BlogAPI\Infrastructure\Formatters;

use Symfony\Component\String\Slugger\AsciiSlugger;

class YoutubeVideoFormatter implements FormatterInterface
{
    /**
     * @param array $data
     *
     * @return array
     */
    public function formatted(object $data): array
    {
        $slug = strtolower((new AsciiSlugger())->slug($data->getSnippet()->getTitle())->toString());

        return [
            'title'            => $data->getSnippet()->getTitle(),
            'slug'             => $slug,
            'description'      => $data->getSnippet()->getDescription(),
            'youtube_video_id' => $data->getId(),
            'image'            => $data->getSnippet()->getThumbnails()->getHigh()->getUrl(),
            'tags'             => $data->getSnippet()->getTags(),
            'active'           => true,
            'publish_at'       => $data->getSnippet()->getPublishedAt(),
        ];
    }
}
