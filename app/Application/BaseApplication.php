<?php
declare(strict_types = 1);

namespace Application;

use Laravel\Lumen\Application;

class BaseApplication extends Application
{
    protected $namespace = 'Application\\';

    public function path($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'app/Application'.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
