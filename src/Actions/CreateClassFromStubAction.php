<?php

namespace SergeyBruhin\LaravelService\Actions;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateClassFromStubAction
{
    public function execute(
        array  $stub,
        string $serviceName,
        string $className,
        string $directory,
        string $stubPath,
    ): void
    {
        $this->createClass($stub, $serviceName, $className, $directory, $stubPath);
    }

    private function createClass(array $stub, $serviceName, $className, string $directory, $stubPath): void
    {
        $variables = [
            'NAMESPACE' => 'App\\Services\\' . $serviceName,
            'CLASS_NAME' => $className,
            'SERVICE_NAME' => $serviceName,
        ];

        if ($stub['directory']) {
            $directory .= '/' . $stub['directory'];
            $variables['NAMESPACE'] = $variables['NAMESPACE'] . '\\' . Str::ucfirst($stub['directory']);
        }

        $filePath = $directory . '/' . $className . '.php';
        $classContent = $this->generateClassContent($stubPath, $variables);

        $directory = pathinfo($filePath, PATHINFO_DIRNAME);

        File::ensureDirectoryExists($directory);
        File::put($filePath, $classContent);

    }


    private function generateClassContent(string $stubPath, array $variables): string
    {
        $contents = file_get_contents($stubPath);

        foreach ($variables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;
    }

}
