<?php
namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class FieldsProcessorFactorySpec extends ObjectBehavior {

  function it_is_initializable($wrapper,$file_adapter) {
    $this->shouldHaveType('FieldsProcessorFactory');
    $this->shouldImplement('FieldsProcessorFactoryInterface');
  }

  function let($wrapper,$file_adapter){
    $wrapper->beADoubleOf('DrupalEntityAdapter');
    $file_adapter->beADoubleOf('DrupalFileAdapter');
    $file_adapter = FieldsProcessorImageDecoratorSpec::set_image_url_callback($file_adapter,'http://tp1.ca/public/250X350_advisor_picture.png');
    $this->beConstructedWith($file_adapter);
  }

  function it_return_void_processor_object($wrapper) {
    $original_array = array(
      'type'=>'wrong_type',
      'node'=>'node_object',
    );
    $void_processor = $this->get_fields_processor($original_array,$wrapper);
    $void_processor->shouldReturnAnInstanceOf('FieldsProcessorNullObject');
    $void_processor->process_fields()->shouldReturn($original_array);
  }

  function it_return_field_processor_page($wrapper) {
    $node = array(
      'type'=>'page',
      'node'=>'node_object',
      );
    $this->get_fields_processor($node,$wrapper)->shouldReturnAnInstanceOf('FieldsProcessor');
  }
}
