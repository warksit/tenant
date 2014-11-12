<?php

namespace spec\Warksit\Tenant;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TenantSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Warksit\Tenant\Tenant');
    }

    function it_returns_null_before_being_set()
    {
        $this->getTenantId()->shouldReturn(null);
    }

    function it_stores_the_tenant_id()
    {
        $id=55;
        $this->setTenantId($id);
        $this->getTenantId()->shouldReturn($id);
    }

    function it_can_be_disabled()
    {
        $this->disabled()->shouldBe(false);
        $this->disable();
        $this->disabled()->shouldBe(true);
    }

    function it_should_return_null_once_disabled()
    {
        $id=55;
        $this->setTenantId($id);
        $this->disable();
        $this->getTenantId()->shouldReturn(null);
    }

}
