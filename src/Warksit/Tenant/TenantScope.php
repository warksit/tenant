<?php  namespace Warksit\Tenant;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ScopeInterface;

class TenantScope implements ScopeInterface {
    private $tenant_id;
    private $tenant_column = 'franchise_id';

    function __construct()
    {

    }


    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @throws TenantNotSetError
     * @return void
     */
    public function apply(Builder $builder)
    {

        if(($tenant_id = \Tenant::getTenantId()) === null)
            throw new TenantNotSetError();

        $this->tenant_id = $tenant_id;

        //Handle special case
        if($tenant_id==0) return;

        $builder->whereRaw("$this->tenant_column = $this->tenant_id");

//        $builder->where(function($query)
//        {
//            $query->where($this->tenant_column,$this->tenant_id);
//        });

    }

    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder $builder
     * @return void
     */
    public function remove(Builder $builder)
    {
        if(\Tenant::getTenantId()==0) return;

        $query = $builder->getQuery();


        foreach ((array) $query->wheres as $key => $where)
        {
            if (strpos($where['sql'],$this->tenant_column) !== false)
            {

                unset($query->wheres[$key]);
            }
        }
        $query->wheres = array_values($query->wheres);
    }

    public function creating(Model $model)
    {
        if(($tenant_id = \Tenant::getTenantId()) === null)
            throw new TenantNotSetError();

        \Log::info("Setting {$this->tenant_column} to {$tenant_id} for " . get_class($model));

        $model->{$this->tenant_column} = $tenant_id;

    }
}