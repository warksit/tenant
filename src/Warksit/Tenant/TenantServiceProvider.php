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
	}


    public function boot()
    {

        $this->package('Warksit/tenant');

        $tenantScope = new TenantScope();

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
