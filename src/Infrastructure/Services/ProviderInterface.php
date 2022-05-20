<?php
namespace BlogAPI\Infrastructure\Services;

interface ProviderInterface
{
	public function getContent(array $criteria);
}
