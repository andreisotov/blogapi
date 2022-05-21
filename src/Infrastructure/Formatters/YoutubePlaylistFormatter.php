<?php

namespace BlogAPI\Infrastructure\Formatters;

use Symfony\Component\String\Slugger\AsciiSlugger;

class YoutubePlaylistFormatter implements FormatterInterface
{
	private const DEFAULT_ACTIVE = 1;

	/**
	 * @param array $data
	 *
	 * @return array
	 */
	public function formatted(array $data): array
	{
		return [
			'title'               => $data['snippet']['title'],
			'slug'                => strtolower((new AsciiSlugger())->slug($data['snippet']['title'])->toString()),
			'description'         => $data['snippet']['description'],
			'youtube_playlist_id' => $data['id']['playlistId'],
			'image'               => $data['snippet']['thumbnails']['high']['url'],
			'active'              => self::DEFAULT_ACTIVE,
			'publish_at'          => $data['snippet']['publishedAt'],
		];
	}
}
