<?php

namespace spec\Warksit\tenant;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Warksit\Tenant\TenantTrait;

class TenantTraitSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf('spec\Warksit\tenant\Foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('spec\Warksit\tenant\Foo');
    }
    
}

class Foo
{
    //use TenantTrait;
}