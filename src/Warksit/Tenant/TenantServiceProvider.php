<?php namespace Warksit\Tenant;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Database\Eloquent\Model;

class TenantServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->singleton('tenant', function(){
            $tenant = new Tenant();
            return $tenant;
        });

        // Get config loader
        $loader = $this->app['config']->getLoader();

        // Get environment name
        $env = $this->app['config']->getEnvironment();

        // Add package namespace with path set base on your requirement
        $loader->addNamespace('warksit',__DIR__.'/../config/warksit');

        // Load package override config file
        $configs = $loader->load($env,'config','warksit');

        // Override value
        $this->app['config']->set('tenant::config',$configs);
	}


    public function boot()
    {

        $this->package('Warksit/tenant');

        $tenantScope = new TenantScope();

        dd($this->app['config']->get('tenant::models'));

        foreach (\Config::get('package::models') as $model) {
            $model::creating(function (Model $model) use ($tenantScope) {
                \Log::info('Observer added to ' . $model);
                $tenantScope->creating($model);
            });
        }
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
