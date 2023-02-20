<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Contracts\DoctrineCustomType;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\Finder\Finder;

/**
 * Class FindDoctrineCustomTypes
 *
 * @package App\Console\Commands
 */
final class FindDoctrineCustomTypes extends Command
{
    const MAP_NAME = 'doctrine_custom_types.json';

    const MAP_FOLDER = 'mappings';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'doctrine:custom-types:find';

    /**
     * The console command description.
     */
    protected $description = 'Finds all the custom types in the project and generates a map file';

    /**
     * @var array|string[]
     */
    private array $allowedInterfacesForMapping = [
        DoctrineCustomType::class,
    ];

    /**
     * The mapper containing all the custom types paths and namespaces
     *
     * @var array
     */
    private static array $mapper = [];

    /**
     * @return void
     */
    public function handle() : void
    {
        $path = 'src';

        $namespace = '\\ProfessorGradingApp';

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
                    self::$mapper[$reflectionClass->getShortName()] = $reflectionClass->getName();

            } catch (ReflectionException $exception){

                $this->info(sprintf('Invalid file %s: %s', $file->getRealPath(), $exception->getMessage()));
            }
        }

        $this->storeMapperFile();
    }

    /**
     * @return void
     */
    private function storeMapperFile() : void
    {
        $path = $this->storagePath();

        $content = json_encode(self::$mapper, JSON_PRETTY_PRINT);

        $status = Storage::put($this->storagePath(), $content);

        $this->getOutput()->writeln(sprintf("Found %d resource(s)", count(self::$mapper)));

        $message = $status ? "Successfully stored in $path" : "Can't store the mapping file in $path";

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
