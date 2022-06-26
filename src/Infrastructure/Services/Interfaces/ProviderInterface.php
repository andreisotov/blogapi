<?php
namespace BlogAPI\Infrastructure\Services\Interfaces;

interface ProviderInterface
{
	public function getContent(array $criteria);
}
