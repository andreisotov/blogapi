<?php
/**
 * Created by site-town.com
 * User: ansotov
 * Date: 23.05.2022
 * Time: 9:33 AM
 */
namespace Infrastructure\Formatters;

use BlogAPI\Infrastructure\Formatters\YoutubeVideoFormatter;
use PHPUnit\Framework\TestCase;

class YoutubeVideoFormatterTest extends TestCase
{

	public function testFormatted()
	{
		$youtubeApiChannel = [
			"kind"    => "youtube#searchResult",
			"id"      => [
				"kind"    => "youtube#video",
				"videoId" => "igQDjenagzw"
			],
			"snippet" => [
				"publishedAt"          => "2021-12-23T21:22:07Z",
				"channelId"            => "UCf6j8AeiqXC37yVgc1iSjTQ",
				"title"                => "Войти в IT, моя история как я стал программистом",
				"description"          => "У каждого человека есть своя история как он пришел к какому-либо решению. В этом видео я рассказываю свою историю ...",
				"thumbnails"           => [
					"default" => [
						"url"    => "https://i.ytimg.com/vi/igQDjenagzw/default.jpg",
						"width"  => 120,
						"height" => 90
					],
					"medium"  => [
						"url"    => "https://i.ytimg.com/vi/igQDjenagzw/mqdefault.jpg",
						"width"  => 320,
						"height" => 180
					],
					"high"    => [
						"url"    => "https://i.ytimg.com/vi/igQDjenagzw/hqdefault.jpg",
						"width"  => 480,
						"height" => 360
					]
				],
				"channelTitle"         => "ansotov",
				"liveBroadcastContent" => "none",
				"publishTime"          => "2021-12-23T21:22:07Z"
			]
		];

		$youtubeVideoFormatter = new YoutubeVideoFormatter();
		$formatterResult       = $youtubeVideoFormatter->formatted($youtubeApiChannel);

		$this->assertEquals('igQDjenagzw', $formatterResult['youtube_video_id']);
	}
}
