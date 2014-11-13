<?php namespace Warksit\Tenant;

use Illuminate\Foundation\Application;

abstract class TenantBaseClass {
    /**
     * The column to be set
     * @var
     */
    protected $tenant_column;

    /**
     * The tenant_is the column should be set to
     * @var
     */
    protected $tenant_id;

    /**
     * Whether the tenant facility has been disabled
     * @var
     */
    protected $disabled;

    /**
     * @var Application
     */
    private $app;

    /**
     * @param Application $app
     */
    function __construct(Application $app)
    {
        $tenant = $app['tenant'];
        $this->tenant_column = $app['config']->get('tenant::column');
        $this->tenant_id = $tenant->getTenantId();
        $this->disabled = $tenant->disabled();
        $this->app = $app;
    }

    /**
     * Ensure that the latest tenant values are used
     */
    public function refreshTenant()
    {
        $tenant = $this->app['tenant'];

        $this->tenant_id = $tenant->getTenantId();
        $this->disabled = $tenant->disabled();
    }
} 