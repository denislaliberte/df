<?php

class FieldsProcessorNullObject implements FieldsProcessorInterface {
  
  private $node_array;

  public function __construct(array $node_array) {
    $this->node_array = $node_array;
  }

  public function process_fields() {
    return $this->node_array;
  }
}
