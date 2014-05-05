<?php

class FieldsProcessorFactory implements FieldsProcessorFactoryInterface {
  private $file_adapter;
  public function __construct(DrupalFileAdapter $file_adapter){
    $this->file_adapter = $file_adapter;
  }

  public static function factory() {
    $file_adapter = new DrupalFileAdapter();
    return new FieldsProcessorFactory($file_adapter);
  }

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
