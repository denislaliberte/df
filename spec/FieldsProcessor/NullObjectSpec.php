<?php

namespace spec\FieldsProcessor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NullObjectSpec extends ObjectBehavior
{
  function it_is_initializable() {
    $this->shouldHaveType('FieldsProcessor\NullObject');
    $this->shouldImplement('FieldsProcessor\FieldsProcessorInterface');
  }

  function let() {
    $this->beConstructedWith();
  }

  function it_returns_empty_array() {
    $this->process_fields()->shouldReturn(array());
  }

}
