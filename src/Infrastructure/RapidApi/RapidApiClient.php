<?php
namespace BlogAPI\Infrastructure\RapidApi;

use BlogAPI\Infrastructure\Services\ProviderInterface;
use DateTimeImmutable;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Utils;
use function Symfony\Component\DependencyInjection\Loader\Configurator\env;

class RapidApiClient implements ProviderInterface
{
	const API_YOUTUBE_URL_SEARCH = 'https://youtube-v31.p.rapidapi.com/search';

	private Client $client;

	public function __construct()
	{
		$this->client = new Client(
			[
				'headers' =>
					['X-RapidAPI-Key' => env('RAPID_API_TOKEN')]
			]
		);
	}

	/**
	 * @param array $criteria
	 *
	 * @return float|object|int|bool|array|string|null
	 * @throws \GuzzleHttp\Exception\GuzzleException
	 */
	public function getContent(array $criteria): float|object|int|bool|array|string|null
	{
		$params = $criteria['params'] ? '?' . http_build_query($criteria['params']) : null;

		try {
			$response = $this->client->request(
				'GET',
				self::API_YOUTUBE_URL_SEARCH . $params
			);
		} catch (Exception $exception) {
			return $exception->getMessage();
		}

		return Utils::jsonDecode(
			$response->getBody()->getContents(), true
		);
	}
}
