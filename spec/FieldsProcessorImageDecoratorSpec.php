<?php
namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class FieldsProcessorImageDecoratorSpec extends ObjectBehavior
{
  function it_is_initializable($fields_processor,$file_adapter) {
    $this->beConstructedWith($fields_processor,$file_adapter,array('field_advisor_picture'));
    $this->shouldHaveType('FieldsProcessorImageDecorator');
    $this->shouldImplement('FieldsProcessorInterface');
  }

  function let($fields_processor,$file_adapter) {
    $fields_processor->beADoubleOf('FieldsProcessor');
    $file_adapter->beADoubleOf('DrupalFileAdapter');
  }

  function it_add_image_file_path_to_variables($fields_processor,$file_adapter) {
    $fields_processor_return_value = array(
      'field_advisor_picture' => array(
        'uri'=>'public://250X350_advisor_picture.png',
      ),
    );
    $fields_processor->process_fields()->willReturn($fields_processor_return_value);
    $image_url = 'http://tp1.ca/public/images/250X350_advisor_picture.png';
    $file_adapter = $this->set_image_url_callback($file_adapter,$image_url);
    $this->beConstructedWith($fields_processor,$file_adapter,array('field_advisor_picture'));
    $expected_value = $this->set_expected_url($fields_processor_return_value,$image_url);
    $this->process_fields()->shouldReturn($expected_value);
  }

  function set_expected_url($fields_processor_return_value,$image_url){
    $fields_processor_return_value['field_advisor_picture']['image_url'] = $image_url;
    return $fields_processor_return_value;
  }

  public static function set_image_url_callback($file_adapter,$image_url) {
    $file_callback = function($field_image_calue) use($image_url){
      return $image_url;
    };
    $file_adapter->get_image_url_callback()->willReturn($file_callback);
    return $file_adapter;
  }
}
