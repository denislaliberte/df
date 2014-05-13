<?php

namespace DrupalAdapter;

class FileSystem {

  public function get_image_url_callback(){
    $get_iamge_url = function ($image_field_value){
      return isset($image_field_value['uri'])? file_create_url($image_field_value['uri']):"";
    };
    return $get_iamge_url;
  }
}
