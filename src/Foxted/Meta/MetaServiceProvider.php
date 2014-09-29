<?php  namespace Foxted\Meta;

use Illuminate\Support\ServiceProvider;

/**
 * Class MetaServiceProvider
 *
 * @package Foxted\Meta
 * @author  Valentin PRUGNAUD <valentin@whatdafox.com>
 * @url http://www.foxted.com
 */
class MetaServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
        if(!isset($app['html'])) $this->registerHtmlBuilder();
        
        $this->app->bind('meta', function ( $app )
        {
            return new Meta($app['view'], $app['html'], $app['blade.compiler'], $app['config']);
        });

    }

    /**
     * Boot method
     */
    public function boot()
    {
        $this->package('foxted/meta');
        include(__DIR__.'/BladeExtension.php');
    }

    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return array('meta');
    }

    /**
     * Register the HTML builder instance.
     *
     * @return void
     */
    protected function registerHtmlBuilder()
    {
        $this->app->bindShared('html', function($app)
        {
            return new \Illuminate\Html\HtmlBuilder($app['url']);
        });
    }

}