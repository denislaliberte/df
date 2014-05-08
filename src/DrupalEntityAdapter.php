<?php

class DrupalEntityAdapter
{
  private $DrupalEntities;

  public function __construct($DrupalEntitiesWrapper) {
    $this->DrupalEntities = $DrupalEntitiesWrapper;
  }

  public static function factory(stdClass $node){
    $wrapper = entity_metadata_wrapper('node', $node);
    return new DrupalEntityAdapter($wrapper);
  }
  public function get_field_value($field_key) {
    $value = $this->DrupalEntities->$field_key->value();
    return !is_null($value)? $value : "";
  }
//  public function get_image_url($image_field_value){
//    return isset($image_field_value['uri'])? file_create_url($image_field_value['uri']):"";
//  }
}
