<?php

class FieldsProcessor implements FieldsProcessorInterface {
  private $entity;
  private $field_key;

  public function __construct(DrupalEntityAdapter $drupal_entity, array $field_key) {
    $this->entity = $drupal_entity;
    $this->field_key = $field_key;
  }

  public function process_fields() {
    $key_with_value = array_combine($this->field_key,$this->field_key);
    $variables = $this->extract_field_value($key_with_value);
    return $variables;
  }

  private function extract_field_value($key_with_value) {
    $process_field = $this->get_process_field_function();
    $variables = array_reduce($key_with_value,$process_field,array());
    return  $variables;
  }

  private function get_process_field_function(){
    $process_field =  function($carry,$field_key) {
      $field_value = $this->get_field_value($field_key);
      $carry[$field_key] = $field_value;
      return $carry;
    };
    return $process_field;
  }

  private function get_field_value($field_key) {
    return $this->entity->get_field_value($field_key);
  }
}
