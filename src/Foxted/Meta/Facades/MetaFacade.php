<?php  namespace Foxted\Meta\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MetaFacade
 *
 * @package Foxted\Meta\Facades
 * @author  Valentin PRUGNAUD <valentin@whatdafox.com>
 * @url http://www.foxted.com
 */
class MetaFacade extends Facade
{

    const PAIRED_TAG = 'paired';
    const UNPAIRED_TAG = 'unpaired';

    /**
     * Get facade accessor
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'meta';
    }

}