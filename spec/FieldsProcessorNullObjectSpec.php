<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FieldsProcessorNullObjectSpec extends ObjectBehavior
{
  private $original_array;
  function __construct(){
    $this->original_array = array('type'=>'wrong_type');
  }

  function it_is_initializable() {
    $this->shouldHaveType('FieldsProcessorNullObject');
    $this->shouldImplement('FieldsProcessorInterface');
  }

  function let() {
    $this->beConstructedWith($this->original_array);
  }

  function it_returns_original_array() {
    $this->process_fields()->shouldReturn($this->original_array);
  }

}
