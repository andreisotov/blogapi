<?php

namespace Infrastructure\Formatters;

use BlogAPI\Infrastructure\Formatters\YoutubePlaylistFormatter;
use PHPUnit\Framework\TestCase;

class YoutubePlaylistFormatterTest extends TestCase
{

	public function testFormatted()
	{
		$youtubeApiChannel = [
			"kind"    => "youtube#searchResult",
			"id"      => [
				"kind"       => "youtube#playlist",
				"playlistId" => "PL_hLrCLhvMytoyVxGalpbJommIwDjp1rR"
			],
			"snippet" => [
				"publishedAt"          => "2021-07-18T16:47:04Z",
				"channelId"            => "UCf6j8AeiqXC37yVgc1iSjTQ",
				"title"                => "Чехия",
				"description"          => "",
				"thumbnails"           => [
					"default" => [
						"url"    => "https://i.ytimg.com/vi/vVp7tJcJnFs/default.jpg",
						"width"  => 120,
						"height" => 90
					],
					"medium"  => [
						"url"    => "https://i.ytimg.com/vi/vVp7tJcJnFs/mqdefault.jpg",
						"width"  => 320,
						"height" => 180
					],
					"high"    => [
						"url"    => "https://i.ytimg.com/vi/vVp7tJcJnFs/hqdefault.jpg",
						"width"  => 480,
						"height" => 360
					]
				],
				"channelTitle"         => "ansotov",
				"liveBroadcastContent" => "none",
				"publishTime"          => "2021-07-18T16:47:04Z"
			]
		];

		$youtubePlaylistFormatter = new YoutubePlaylistFormatter();
		$formatterResult          = $youtubePlaylistFormatter->formatted($youtubeApiChannel);

		$this->assertEquals('PL_hLrCLhvMytoyVxGalpbJommIwDjp1rR', $formatterResult['youtube_playlist_id']);
	}
}
