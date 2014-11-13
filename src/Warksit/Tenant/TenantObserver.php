<?php namespace Warksit\Tenant;

use Illuminate\Database\Eloquent\Model;
use Warksit\Tenant\Errors\TenantNotSetError;

class TenantObserver extends TenantBaseClass {

    /**
     * Set the column to the value when creating an observed model
     *
     * @param Model $model
     * @throws TenantNotSetError
     */
    public function creating(Model $model)
    {
        $this->refreshTenant();

        if($this->disabled) return;

        if($this->tenant_id  === null)
            throw new TenantNotSetError();

        $model->{$this->tenant_column} = $this->tenant_id;
    }
}
