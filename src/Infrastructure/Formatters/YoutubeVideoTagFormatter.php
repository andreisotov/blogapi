<?php

namespace BlogAPI\Infrastructure\Formatters;

use BlogAPI\Domain\Tags\Tag;
use Symfony\Component\String\Slugger\AsciiSlugger;

class YoutubeVideoTagFormatter implements FormatterInterface
{
    /**
     * @param object $data
     *
     * @return \BlogAPI\Domain\Tags\Tag
     */
	public function formatted(object $data): Tag
	{
        $slug = strtolower((new AsciiSlugger())->slug($data->tag));

        $tag = new Tag();
        $tag->setTitle($data->tag);
        $tag->setSlug($slug);

        return $tag;
	}
}
