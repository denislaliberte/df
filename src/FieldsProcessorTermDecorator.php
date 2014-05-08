<?php

class FieldsProcessorTermDecorator implements FieldsProcessorInterface
{
    private $fields_processor;
    private $key;
    private $factory;
    public function __construct(FieldsProcessorInterface $fields_processor,FieldsProcessorFactoryInterface $factory,$key){
      $this->fields_processor = $fields_processor;
      $this->key = $key;
      $this->factory = $factory;
    }

    public function process_fields()
    {
      $field_variables = $this->fields_processor->process_fields();
      $tax = $this->factory->entityFactory($field_variables[$this->key],'taxonomy_term');
      $field_variables[$this->key] = $tax->get_field_value('name');
      return $field_variables;
    }
}
