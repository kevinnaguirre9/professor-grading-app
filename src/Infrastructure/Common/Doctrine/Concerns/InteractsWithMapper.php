<?php

namespace ProfessorGradingApp\Infrastructure\Common\Doctrine\Concerns;

use Illuminate\Support\Facades\Storage;

/**
 * Trait InteractsWithMapper
 *
 * @package App\Console
 */
trait InteractsWithMapper
{
    /**
     * @param array $mapper
     * @param string $location
     * @return bool
     */
    protected static function store(array $mapper, string $location): bool
    {
        $content = json_encode($mapper, JSON_PRETTY_PRINT);

        return Storage::put($location, $content);
    }

    /**
     * @param string $location
     * @return array
     */
    protected static function fetch(string $location): array
    {
        if (! Storage::exists($location))
            throw new \RuntimeException("Mapper file $location not found");

        $fileContents = Storage::get($location);

        return json_decode($fileContents, true);
    }
}
