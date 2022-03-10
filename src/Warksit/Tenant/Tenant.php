<?php  namespace Warksit\Tenant;

class Tenant {
    /**
     * @var
     */
    private $tenant_id = null;

    /**
     * @var bool
     */
    private $is_disabled = false;

    /**
     * Retrieves the tenant_id
     * @return mixed
     */
    public function getTenantId()
    {
        return $this->tenant_id;
    }

    /**
     * Sets the tenant_id
     * @param mixed $tenant_id
     */
    public function setTenantId($tenant_id)
    {
        $this->tenant_id = $tenant_id;
        $this->is_disabled = false;
    }

    /**
     * Disables the tenant scoping/observer
     */
    public function disable(){
        $this->is_disabled = true;
        $this->tenant_id = null;
    }

    /**
     * Disables the tenant scoping/observer
     */
    public function enable() {
        $this->is_disabled = false;
    }

    /**
     * Retrieves disabled status
     * @return bool
     */
    public function disabled(){
        return $this->is_disabled;
    }
} 