<?php 

namespace FieldsProcessor;

use DrupalAdapter\Entity;
use DrupalAdapter\VoidEntity;
use DrupalAdapter\FileSystem;

use FieldsProcessor\FactoryInterface;


abstract class FactoryAbstract implements FactoryInterface {
  protected $file_adapter;
  public function __construct(FileSystem $file_adapter){
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
      $adapter = new Entity($wrapper);
    }
    else{
      $adapter = new VoidEntity();
    }
    return $adapter;
  }
  abstract function get_fields_processor(Entity $entity);

}
