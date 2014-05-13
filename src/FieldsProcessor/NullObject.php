<?php

namespace FieldsProcessor;


class NullObject implements FieldsProcessorInterface {

  public function __construct() {
  }

  public function process_fields() {
    return array();
  }
}
