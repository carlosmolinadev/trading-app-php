<?php

namespace App\Contracts;

interface ISettingService
{
    public function getSettings(int $id, array $searchParameters): array;
}
