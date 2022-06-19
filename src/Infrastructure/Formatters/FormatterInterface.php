<?php

namespace BlogAPI\Infrastructure\Formatters;

interface FormatterInterface
{
	public function formatted(object $data): array|object;
}
