<?php

class FieldsProcessorFactory extends FieldsProcessorFactoryAbstract implements FieldsProcessorFactoryInterface {
  public function get_fields_processor(array $node_array,DrupalEntityAdapter $entity) {
    switch($node_array['type']){
    case 'page':
      return new FieldsProcessor($entity,array('body'));
    break;
    default:
      return new FieldsProcessorNullObject($node_array);
    }
  }
}
