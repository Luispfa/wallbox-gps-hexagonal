<?php

declare(strict_types=1);

namespace App\Application\Response;

final class EvsResponse
{
    private  $evs;

    public function __construct(string ...$evs)
    {
        $this->evs = $evs;
    }

    public function evs(): array
    {
        return $this->evs;
    }
}