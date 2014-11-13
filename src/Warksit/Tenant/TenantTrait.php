<?php namespace Warksit\Tenant;

trait TenantTrait {
    /**
     * Add the global scope when the model is booted
     */
    public static function bootTenantTrait()
    {
        static::addGlobalScope(\App::make('Warksit\Tenant\TenantScope'));
    }
}