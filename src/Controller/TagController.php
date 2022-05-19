<?php

namespace BlogAPI\Controller;

use BlogAPI\Application\Handler\Tag\ListTagHandler;
use BlogAPI\Domain\Tags\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
	public function __construct(
		private ListTagHandler $listTagHandler
	) {

	}

	#[Route('/api/tags', methods: ['GET'])]
	public function index(): JsonResponse
	{
		$tags = $this->listTagHandler->handle();

		$allTags = [];

		/** @var Tag $tags */
		foreach ($tags as $tag) {

			$allTags[] = [
				'id'          => $tag->getId(),
				'title'       => $tag->getTitle(),
				'slug'        => $tag->getSlug(),
			];
		}

		return new JsonResponse($allTags);
	}
}
