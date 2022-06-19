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
		return [
			'title'            => $data->getTitle(),
			'slug'             => $data->getSlug(),
			'description'      => $data->getDescription(),
			'youtube_video_id' => $data->getYoutubeVideoId(),
			'image'            => $data->getImage(),
			'active'           => $data->isActive(),
			'publish_at'       => $data->getPublishAt(),
		];
	}
}
