<?php
namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Prophecy\Prophet;

class FieldsProcessorSpec extends ObjectBehavior {

  function it_is_initializable($wrapper) {
    $this->beConstructedWith($wrapper,array());
    $this->shouldHaveType('FieldsProcessor');
    $this->shouldImplement('FieldsProcessorInterface');
  }

  function let($wrapper) {
    $wrapper->beADoubleOf('DrupalEntityAdapter');
  }

  function it_process_variables($wrapper) {
    $return_variables = $this->get_field_variables();
    $this->setwrapper_get_field_value_function($return_variables,$wrapper);
    //$return_variables_with_image_url = $this->setwrapper_get_image_url_function($return_variables,$wrapper);
    $field_key = array_keys($return_variables);
    $this->beConstructedWith($wrapper,$field_key);//,array('field_advisor_picture'));
    $this->process_fields()->shouldReturn($return_variables);
  }

  public static function setwrapper_get_field_value_function(Array $expected_value,$wrapper) {
    $define_method_expectation = function($value,$key) use ($wrapper){
      $wrapper->get_field_value($key)->willReturn($value);
    };
    array_walk($expected_value,$define_method_expectation);
  }

  public static function setwrapper_get_image_url_function($return_variables,$wrapper) {
    $image_url = "http://tp1.ca/public/250X350_advisor_picture.png";
    $wrapper->get_image_url($return_variables['field_advisor_picture'])->willReturn($image_url);
    $return_variables['field_advisor_picture']['image_url'] = $image_url;
    return $return_variables;
  }

  private function get_field_variables() {
    //$adresse_array = array('1234 bob avenue', 'montreal');
    //$link_array = array('google.com', 'tp1.ca');
    //$body_array = array('value'=>'this is the body text');
    $image_array = array('uri'=>'public://250X350_advisor_picture.png');
    $return_variables = array(
      'text'=> 'name',
//      'body'=>$body_array,
    //  'field_titre'=> 'titre',
    //  'field_email'=>'test@tp1.ca',
    //  'field_phone'=>'888-888-8888',
    //  'field_address'=>$adresse_array,
    //  'field_company_link'=>$link_array,
      'field_advisor_picture'=>$image_array,
    );
    return $return_variables;
  }
}
