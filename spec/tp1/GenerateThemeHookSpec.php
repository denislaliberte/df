<?php

namespace spec\tp1;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GenerateThemeHookSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('tp1\GenerateThemeHook');
    }
    function let(){
        $this->beConstructedWith('theme_folder');

    }

    function it_return_theme_hook(){
        $this->addTheme('asdf');
        $expectedValue = array(
          'asdf'=>array(
            'template'=>  'theme_folder/asdf',
          ),
        );
        $this->getHooks()->shouldReturn($expectedValue);
    }
}
