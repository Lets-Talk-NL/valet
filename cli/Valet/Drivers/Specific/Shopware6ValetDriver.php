<?php

namespace Valet\Drivers\Specific;

use Valet\Drivers\ValetDriver;

class Shopware6ValetDriver extends ValetDriver
{
    /**
     * Determine if the driver serves the request.
     */
    public function serves(string $sitePath, string $siteName, string $uri): bool
    {
        return file_exists($sitePath.'/public/index.php') &&
            file_exists($sitePath.'/vendor/shopware/core/HttpKernel.php');
    }

    /**
     * Determine if the incoming request is for a static file.
     */
    public function isStaticFile(string $sitePath, string $siteName, string $uri)/*: string|false */
    {
        if ($this->isActualFile($staticFilePath = $sitePath.'/public/'.$uri)) {
            return $staticFilePath;
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     */
    public function frontControllerPath(string $sitePath, string $siteName, string $uri): ?string
    {
        $frontControllerPath = $sitePath.'/public/index.php';

        $_SERVER['SCRIPT_FILENAME'] = $frontControllerPath;

        return $frontControllerPath;
    }
}
