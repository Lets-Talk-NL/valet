<?php

namespace Valet\Drivers\Specific;

use Valet\Drivers\ValetDriver;

class Shopware5ValetDriver extends ValetDriver
{
    /**
     * Determine if the driver serves the request.
     */
    public function serves(string $sitePath, string $siteName, string $uri): bool
    {
        return file_exists($sitePath.'/shopware.php');
    }

    /**
     * Determine if the incoming request is for a static file.
     */
    public function isStaticFile(string $sitePath, string $siteName, string $uri)/*: string|false */
    {
        if ($this->isActualFile($staticFilePath = $sitePath.'/'.$uri)) {
            return $staticFilePath;
        }

        return false;
    }

    /**
     * Get the fully resolved path to the application's front controller.
     */
    public function frontControllerPath(string $sitePath, string $siteName, string $uri): ?string
    {
        $_SERVER['DOCUMENT_ROOT'] = $sitePath;
        $_SERVER['SCRIPT_FILENAME'] = $sitePath.'/shopware.php';
        $_SERVER['SCRIPT_NAME'] = '/shopware.php';
        $_SERVER['PHP_SELF'] = '/shopware.php';

        return $sitePath.'/shopware.php';
    }
}
