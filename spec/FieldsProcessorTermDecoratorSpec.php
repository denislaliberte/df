<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FieldsProcessorTermDecoratorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FieldsProcessorTermDecorator');
    }
    function let($fields_processor, $factory,$entity_adaptor,$tax_stub){
      $fields_processor->beADoubleOf('FieldsProcessor');
      $field_value = array('field_taxonomy'=>$tax_stub);
      $fields_processor->process_fields()->willReturn($field_value);

      $entity_adaptor->beADoubleOf('DrupalEntityAdapter');
      $entity_adaptor->get_field_value('name')->willReturn('tax_class');

      $factory->beADoubleOf('FieldsProcessorFactory');
      $factory->entityFactory($tax_stub,'taxonomy_term')->willReturn($entity_adaptor);
      $this->beConstructedWith($fields_processor,$factory,'field_taxonomy');
    }

    function it_add_taxonomy_class_to_variables(){

      $this->process_fields()->shouldHaveValue('tax_class');
    }


    function getMatchers(){
        return array(
            'haveValue'=>function($subject,$value){
                return in_array($value, $subject);
            }
        );
    }

}
