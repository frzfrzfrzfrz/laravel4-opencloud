<?php

namespace Unm\Laravel\OpenCloud;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the OpenCloud service
 */
class OpenCLoudFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'opencloud';
    }
}