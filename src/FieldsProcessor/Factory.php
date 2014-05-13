<?php

namespace FieldsProcessor;

use DrupalAdapter\Entity;
use FieldsProcessor\NullObject;

class Factory extends FactoryAbstract implements FactoryInterface {
  public function get_fields_processor(Entity $entity) {
    switch($entity->get_field_value('type')){
    case 'page':
      return new FieldsProcessor($entity,array('body'));
    break;
    default:
      return new NullObject();
    }
  }
}
