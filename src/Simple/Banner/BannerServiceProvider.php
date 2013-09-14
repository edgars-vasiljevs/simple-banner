<?php namespace Simple\Banner;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Simple\Cms\CmsServiceProvider;
use Config;

class BannerServiceProvider extends ServiceProvider {

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
	public function boot() {

		$this->package('simple/banner');

		// Load CMS aliases
		AliasLoader::getInstance( Config::get('banner::default.aliases') );

		// Load providers
		CmsServiceProvider::loadProviders($this, Config::get('banner::default.providers'));

		// Load CMS routes
		include __DIR__ . '/../../routes.php';


	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}