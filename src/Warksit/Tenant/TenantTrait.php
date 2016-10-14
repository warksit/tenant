<?php namespace Warksit\Tenant;

trait TenantTrait {
    /**
     * Add the global scope when the model is booted
     */
    public static function bootTenantTrait()
    {
        static::addGlobalScope(\App::make('Warksit\Tenant\TenantScope'));
    }
    /**
     * Returns a new builder without the tenant scope applied.
     *
     *     $allUsers = User::allTenants()->get();
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function allTenants()
    {
        return with(new static)->newQueryWithoutScope(\App::make(TenantScope::class));
    }
}