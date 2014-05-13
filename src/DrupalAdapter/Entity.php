<?php

namespace DrupalAdapter;

class Entity
{
  private $DrupalEntities;

  public function __construct($DrupalEntitiesWrapper) {
    $this->DrupalEntities = $DrupalEntitiesWrapper;
  }

  public static function factory( $node){
    $wrapper = entity_metadata_wrapper('node', $node);
    return new Entity($wrapper);
  }
  public function get_field_value($field_key) {
    $value = $this->DrupalEntities->$field_key->value();
    return !is_null($value)? $value : "";
  }
}
