<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use ProfessorGradingApp\Infrastructure\Common\Doctrine\Concerns\InteractsWithMapper;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

/**
 * Class MapDoctrineXmlMappingDocuments
 *
 * @package App\Console\Commands
 */
final class MapDoctrineXmlMappingDocuments extends Command
{
    use InteractsWithMapper;

    const MAP_NAME = 'doctrine_xml_documents.json';

    const MAP_FOLDER = 'mappings';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'doctrine:xml-documents:map';

    /**
     * The console command description.
     */
    protected $description = 'Search all doctrine xml mapping documents and generates a map json file for short-name loading';

    /**
     * @return void
     */
    public function handle() : void
    {
        $path = 'src';

        $mapper = [];

        $finder = new Finder();

        $finder->files()
            ->name('*.dcm.xml')
            ->in(base_path() . DIRECTORY_SEPARATOR . $path);

        $this->getOutput()->writeln(sprintf("Found %d file(s) in %s", $finder->count(), $path));

        foreach ($finder as $file) {
            if (in_array($file->getPath(), $mapper))
                continue;

            $mapper[] = $file->getPath();
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
     * Gets the storage path for the mapped models
     *
     * @return string
     */
    private function storagePath(): string
    {
        return self::MAP_FOLDER . DIRECTORY_SEPARATOR . self::MAP_NAME;
    }
}
