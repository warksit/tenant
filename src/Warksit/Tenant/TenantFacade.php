<?php  namespace Warksit\Tenant;

use Illuminate\Support\Facades\Facade;

class TenantFacade extends Facade{

    protected static function getFacadeAccessor() {return 'tenant';}
} 