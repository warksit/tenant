<?php namespace Warksit\Tenant;

trait TenantTrait {

    public static function bootTenantTrait(){

        $tenantScope = \App::make('Warksit\Tenant\TenantScope');

        // Add the global scope that will handle all operations except create()
        static::addGlobalScope($tenantScope);

    }


} 