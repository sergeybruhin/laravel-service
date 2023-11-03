<?php

namespace SergeyBruhin\LaravelService\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Pluralizer;
use Illuminate\Support\Str;
use SergeyBruhin\LaravelService\Actions\CreateClassFromStubAction;
use SergeyBruhin\LaravelService\Exceptions\StubFileDoesntExistsException;

class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Service Scaffolding';

    private array $subDirectories = [
        'Providers',
        'Interfaces',
        'Actions',
        'Handlers',
        'Facade',
        'Jobs',
        'Events',
        'Listeners',
    ];

    private array $stubs = [
        [
            'fileName' => 'service',
            'className' => 'Service',
            'directory' => null,
            'hasNamePrefix' => true,
        ],
        [
            'fileName' => 'service.interface',
            'className' => 'ServiceContract',
            'directory' => 'Interfaces',
            'hasNamePrefix' => true,
        ],
        [
            'fileName' => 'service.facade',
            'className' => 'Service',
            'directory' => 'Facade',
            'hasNamePrefix' => true,
        ],
        [
            'fileName' => 'service.provider',
            'className' => 'ServiceProvider',
            'directory' => 'Providers',
            'hasNamePrefix' => false,

        ],
        [
            'fileName' => 'service.event-provider',
            'className' => 'EventServiceProvider',
            'directory' => 'Providers',
            'hasNamePrefix' => false,
        ],
    ];

    /**
     * Execute the console command.
     * @throws StubFileDoesntExistsException
     */
    public function handle(): int
    {
        $serviceName = $this->getServiceNameFromArgument();
        $this->createServiceDirectories();

        foreach ($this->stubs as $stub) {

            $className = $this->getClassName($stub, $serviceName);
            $serviceRoot = $this->getServiceRoot();
            $stubPath = $this->getStubPath($stub);

            (new CreateClassFromStubAction)
                ->execute(
                    $stub,
                    $serviceName,
                    $className,
                    $serviceRoot,
                    $stubPath,
                );

            $this->info($className . ' Created');
        }

        return 1;
    }

    private function getClassName(array $stub, string $serviceName): string
    {
        $name = $stub['className'];
        if ($stub['hasNamePrefix']) {
            $name = $serviceName . Str::ucfirst($name);
        }

        return $name;
    }

    private function createServiceDirectories(): void
    {
        $this->createDirectory($this->getServiceRoot());

        foreach ($this->subDirectories as $directoryName) {
            $this->createDirectory($this->getServiceRoot() . '/' . $directoryName);
        }
    }

    private function createDirectory(string $directoryPath): void
    {
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0777, true, false);
        }
    }

    private function getServiceRoot(): string
    {
        return base_path('app/Services/' . $this->getServiceNameFromArgument());
    }

    private function getServiceNameFromArgument(): string
    {
        return ucwords(Pluralizer::singular(
            $this->argument('name')
        ));
    }

    /**
     * @throws StubFileDoesntExistsException
     */
    private function getStubPath(array $stub): string
    {
        $fileName = $stub['fileName'] . '.stub';
        $packageRoot = dirname(__DIR__, 2);
        $appStubPath = base_path('stubs/' . $fileName);
        $packageStubPath = $packageRoot . '/stubs/' . $fileName;

        if (File::exists($appStubPath)) {
            return $appStubPath;
        }
        if (File::exists($packageStubPath)) {
            return $packageStubPath;
        }

        throw new StubFileDoesntExistsException([
            $appStubPath,
            $packageStubPath
        ]);

    }



//    private function createInterface()
//    {
//        $fileName = 'AuthServiceContract';
//        $classContent = '';
//        $this->createClass($fileName, $classContent);
//    }
//
//    private function createService(string $string)
//    {
//        $fileName = 'AuthServiceContract';
//        $this->createClass($fileName);
//    }
//
//    private function createFacade(string $string)
//    {
//        $fileName = 'AuthServiceContract';
//        $this->createClass($fileName);
//
//    }
//
//    private function createProvider(string $string)
//    {
//        $fileName = 'AuthServiceContract';
//        $this->createClass($fileName);
//
//    }


//    public function getStubVariables(string $serviceName): array
//    {
//        return [
//
//        ];
//    }

//    /**
//     * Get the stub path and the stub variables
//     *
//     * @return bool|mixed|string
//     *
//     */
    ////    public function getSourceFile()
    ////    {
    ////        return $this->getStubContents(
    ////            $this->getStubPath(),
    ////            $this->getStubVariables()
    ////        );
    ////    }

//    private function replaceClassContent(string $stubPath, $stubVariables = []): mixed
//    {
//        $contents = file_get_contents($stubPath);
//
//        foreach ($stubVariables as $search => $replace) {
//            $contents = str_replace('$' . $search . '$', $replace, $contents);
//        }
//
//        return $contents;
//
//    }


}
