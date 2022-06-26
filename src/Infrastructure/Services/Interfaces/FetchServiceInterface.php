<?php

namespace BlogAPI\Infrastructure\Services\Interfaces;

use Doctrine\Common\Collections\Collection;

interface FetchServiceInterface
{
    public function fetch(array $input): array|object;
}
