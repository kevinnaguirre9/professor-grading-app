<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Concerns\InteractsWithMapper;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Finder\Finder;

/**
 * Class MapDoctrineCustomTypes
 *
 * @package App\Console\Commands
 */
final class MapDoctrineCustomTypes extends Command
{
    use InteractsWithMapper;

    const MAP_NAME = 'doctrine_custom_types.json';

    const MAP_FOLDER = 'mappings';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'doctrine:custom-types:map';

    /**
     * The console command description.
     */
    protected $description = 'Search all the custom types in the project and generates a map file.';

    /**
     * @var array|string[]
     */
    private array $allowedInterfacesForMapping = [
        DoctrineCustomType::class,
    ];

    /**
     * @return void
     */
    public function handle(): void
    {
        $path = 'src';

        $namespace = '\\ProfessorGradingApp';

        $mapper = [];

        $finder = new Finder();

        $finder->files()
            ->name('*DoctrineType.php')
            ->in(base_path() . DIRECTORY_SEPARATOR . $path);

        $this->getOutput()->writeln(sprintf("Found %d file(s) in %s", $finder->count(), $path));

        foreach ($finder as $file) {

            $ns = $namespace;

            if ($relativePath = $file->getRelativePath())
                $ns .= '\\'.strtr($relativePath, '/', '\\');

            $class = $ns.'\\'.$file->getBasename('.php');

            try{
                $reflectionClass = new ReflectionClass($class);

                if($this->isMappable($reflectionClass))
                    $mapper[] = $reflectionClass->getName();

            } catch (ReflectionException $exception){

                $this->info(sprintf('Invalid file %s: %s', $file->getRealPath(), $exception->getMessage()));
            }
        }

        $this->getOutput()->writeln(sprintf("Found %d resource(s)", count($mapper)));

        $storagePath = $this->storagePath();

        $storeStatus = $this->store($mapper, $storagePath);

        $message = $storeStatus
            ? "Successfully stored in $storagePath"
            : "Can't store the mapping file in $storagePath";

        $this->getOutput()->writeln($message);
    }

    /**
     * @param ReflectionClass $reflectionClass
     * @return bool
     */
    public function isMappable(ReflectionClass $reflectionClass): bool
    {
        foreach ($this->allowedInterfacesForMapping as $item) {
            if ($reflectionClass->implementsInterface($item))
                return true;
        }

        return false;
    }

    /**
     * Gets the storage path for the mapped models
     *
     * @return string
     */
    private function storagePath(): string
    {
        return self::MAP_FOLDER . DIRECTORY_SEPARATOR . self::MAP_NAME;
    }
}
