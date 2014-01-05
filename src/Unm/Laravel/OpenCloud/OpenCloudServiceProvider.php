<?php

namespace Unm\Laravel\OpenCloud;

use Illuminate\Support\ServiceProvider;
use OpenCloud\Rackspace;

class OpenCloudServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->package('unm/laravel4-opencloud', 'opencloud', __DIR__. '/../../..');

        if($this->app['config']->get('opencloud::publish_routes')) {
            include_once(__DIR__ . '/../../../routes.php');
        }

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind('opencloud', function($app) {
            return new OpenCloud($app['config']->get('opencloud::config'));
        });

        # Shortcut so developers don't need to add an Alias in app/config/app.php
//        $this->app->booting(function()
//        {
//            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
//            $loader->alias('rackspace', 'Unm\Laravel\Azure\RackspaceFacade');
//        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('opencloud');
	}

}