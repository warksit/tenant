<?php  namespace Warksit\Tenant;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;
use Warksit\Tenant\Errors\TenantNotSetError;

class TenantScope extends TenantBaseClass implements ScopeInterface {

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @throws TenantNotSetError
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $this->refreshTenant();

        if($this->disabled) return;

        if($this->tenant_id  === null)
            throw new TenantNotSetError();

        $builder->whereRaw("{$builder->getQuery()->from}.$this->tenant_column = $this->tenant_id");
    }

    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    public function remove(Builder $builder, Model $model)
    {
        if($this->disabled) return;

        $query = $builder->getQuery();

        foreach ((array) $query->wheres as $key => $where)
        {
            if (isset($where['sql']) && strpos($where['sql'],$this->tenant_column) !== false)
            {

                unset($query->wheres[$key]);
            }
        }
        $query->wheres = array_values($query->wheres);
    }
}