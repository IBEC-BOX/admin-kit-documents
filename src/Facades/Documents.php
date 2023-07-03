<?php

namespace AdminKit\Documents\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AdminKit\Documents\Documents
 */
class Documents extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \AdminKit\Documents\Documents::class;
    }
}
