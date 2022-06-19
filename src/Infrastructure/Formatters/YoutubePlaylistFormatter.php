<?php

namespace BlogAPI\Infrastructure\Formatters;

use Symfony\Component\String\Slugger\AsciiSlugger;

class YoutubePlaylistFormatter implements FormatterInterface
{
	private const DEFAULT_ACTIVE = 1;

	/**
	 * @param object $data
	 *
	 * @return array
	 */
	public function formatted(object $data): array
	{
		return [
			'title'               => $data->getSnippet()->getTitle(),
			'slug'                => strtolower((new AsciiSlugger())->slug($data->getSnippet()->getTitle())->toString()),
			'description'         => $data->getSnippet()->getDescription(),
			'youtube_playlist_id' => $data->getId(),
			'image'               => $data->getSnippet()->getThumbnails()->getHigh()->getUrl(),
			'active'              => self::DEFAULT_ACTIVE,
			'publish_at'          => $data->getSnippet()->getPublishedAt(),
		];
	}
}
