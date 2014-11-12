<?php namespace Warksit\Tenant;

use Illuminate\Support\ServiceProvider;
use \Illuminate\Database\Eloquent\Model;

class TenantServiceProvider extends ServiceProvider {

    /**
     * The array of models to be observed
     *
     * @var array
     */
    private $modelsToBeObserved;

    /**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

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
        $this->package('Warksit/tenant');
        $this->modelsToBeObserved = $this->app['config']->get('tenant::models');
    }


    /**
     * Attach the observer to the models
     *
     */
    public function boot()
    {

        $tenantObserver = $this->app->make('Warksit\Tenant\TenantObserver');

        foreach ($this->modelsToBeObserved as $modelToBeObserved) {
            $modelToBeObserved::creating(function (Model $model) use ($tenantObserver) {
                \Log::info('Observer added to ' . get_class($model));
                $tenantObserver->creating($model);
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
