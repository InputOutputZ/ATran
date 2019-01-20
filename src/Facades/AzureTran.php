<?php

namespace  AzureTran\Translate\Facades;

use Illuminate\Support\Facades\Facade;

class AzureTran extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'azuretranslate';
    }
}