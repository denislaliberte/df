<?php

interface FieldsProcessorFactoryInterface
{
  public function get_fields_processor(array $node,DrupalEntityAdapter $entity);
}
