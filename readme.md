## Simple Package to deal with Multi-Tenant Application

Work in progress inspired by @HipsterJazzbo but app about to go live so needed something I was in control of.


Add Service Provider

        'Warksit\Tenant\TenantServiceProvider',

Add Facade

        'Tenant'        	=> 'Warksit\Tenant\TenantFacade',

use WarksIt/tenant/TenantTrait;

in models to scope then by the tenant_id

Publish config and update models and then an observer is set in the ServiceProvider. I found boot method of Eloquent model too unreliable to set there.

php artisan config:publish Warksit/tenant

