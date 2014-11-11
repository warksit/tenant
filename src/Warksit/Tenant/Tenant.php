<?php  namespace Warksit\Tenant;

class Tenant {

    private $tenant_id = null;

    /**
     * @return mixed
     */
    public function getTenantId()
    {
        return $this->tenant_id;
    }

    /**
     * @param mixed $tenant_id
     */
    public function setTenantId($tenant_id)
    {
        \Log::info("Tenant set to $tenant_id");
        $this->tenant_id = $tenant_id;
    }

    public function disable(){
        $this->tenant_id = 0;
    }
} 