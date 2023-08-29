<?php

namespace App\Services;

interface BaseServiceInterface
{
    /**
     * interface for execute any service action.
     *
     * @param array $dto
     */
    public function execute(array $dto): array;
}
