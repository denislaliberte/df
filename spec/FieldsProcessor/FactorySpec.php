<?php
namespace spec\FieldsProcessor;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

use DrupalAdapter\Entity;
use DrupalAdapter\FileSystem;
use spec\FieldsProcessor\ImageDecoratorSpec;

class FactorySpec extends ObjectBehavior {

  function it_is_initializable($wrapper,$file_adapter) {
    $this->shouldHaveType('FieldsProcessor\Factory');
    $this->shouldImplement('FieldsProcessor\FactoryInterface');
  }

  function let($wrapper,$file_adapter){
    $wrapper->beADoubleOf('DrupalAdapter\Entity');
    $file_adapter->beADoubleOf('DrupalAdapter\FileSystem');
    $file_adapter = ImageDecoratorSpec::set_image_url_callback($file_adapter,'http://tp1.ca/public/250X350_advisor_picture.png');
    $this->beConstructedWith($file_adapter);
  }

  function it_return_void_processor_object($wrapper) {
    $original_array = array(
      'type'=>'wrong_type',
      'node'=>'node_object',
    );
    $void_processor = $this->get_fields_processor($wrapper);
    $void_processor->shouldReturnAnInstanceOf('FieldsProcessor\NullObject');
    $void_processor->process_fields()->shouldReturn(array());
  }

  function it_return_field_processor_page($wrapper) {
    $wrapper->get_field_value('type')->willReturn('page');
    $this->get_fields_processor($wrapper)->shouldReturnAnInstanceOf('FieldsProcessor\FieldsProcessor');
  }
}
