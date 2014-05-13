<?php

namespace FieldsProcessor;

use DrupalAdapter\FileSystem;



class ImageDecorator implements FieldsProcessorInterface {
  private $fields_processor;
  private $field_image_key;
  private $file_adapter;

  public function __construct(FieldsProcessorInterface $fields_processor,FileSystem $file_adapter, array $field_image_key){
    $this->fields_processor = $fields_processor;
    $this->file_adapter = $file_adapter;
    $this->field_image_key = $field_image_key;
  }

  public function process_fields() {
    $field_variables = $this->fields_processor->process_fields();
    $field_variables_withImage = $this->add_image_url($field_variables);
    return $field_variables_withImage;
  }

    //todo : refactor to use array reduce // possible duplication with fieldProcessing
    //
  private function add_image_url(array $variables) {
    $add_image_url = $this->get_add_image_url();
    array_walk($variables,$add_image_url,$this->field_image_key);
    return $variables;
  }

  private function get_add_image_url(){
    $file_create_url = $this->file_adapter->get_image_url_callback();
    $add_image_url = function(&$item,$key,$image_key) use($file_create_url){
      if(in_array($key,$image_key)){
        $item['image_url'] = $file_create_url($item);
      }
    };
    return $add_image_url;
  }
}










