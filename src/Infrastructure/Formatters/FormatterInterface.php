<?php

namespace BlogAPI\Infrastructure\Formatters;

interface FormatterInterface
{
	public function formatted(array $data): array;
}
