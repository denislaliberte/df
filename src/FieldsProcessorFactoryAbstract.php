<?php 

abstract class FieldsProcessorFactoryAbstract implements FieldsProcessorFactoryInterface {
  protected $file_adapter;
  public function __construct(DrupalFileAdapter $file_adapter){
    $this->file_adapter = $file_adapter;
  }

  public static function factory() {
    $file_adapter = new DrupalFileAdapter();
    return new FieldsProcessorFactory($file_adapter);
  }

  public function entityFactory($node, $type= 'node')
  {
    if(is_object($node)){
      $wrapper = entity_metadata_wrapper($type, $node);
      $adapter = new DrupalEntityAdapter($wrapper);
    }
    else{
      $adapter = new DrupalEntityVoidAdapter();
    }
    return $adapter;
  }
  abstract function get_fields_processor(array $node_array,DrupalEntityAdapter $entity);

}
