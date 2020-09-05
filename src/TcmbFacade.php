<?php

namespace Elvendor\Tcmb;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Elvendor\Tcmb\Skeleton\SkeletonClass
 */
class TcmbFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'tcmb';
    }
}
