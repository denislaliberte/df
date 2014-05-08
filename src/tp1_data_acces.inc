<?php
define("VOID_TERM_ID",0);

//todo refactor to use class

function _tp1_get_current_node_term_refenrence_id($field_taxonomy){
  $current_node = menu_get_object();
  $package_taxonomy_id = isset($current_node->$field_taxonomy) ? _get_node_term_reference_id($current_node,$field_taxonomy) : VOID_TERM_ID;
  return $package_taxonomy_id;
}

function _get_node_term_reference_id($node,$term_field){
  $node_wrapper = entity_metadata_wrapper('node', $node);
  $term_field = $node_wrapper->$term_field;
  $term_value = $term_field->value();
  $tid = !empty($term_value)? $term_value->tid : VOID_TERM_ID;
  return $tid;
}

function _tp1_get_node_query_by_bundle($bundle_name){
  global $language;
  $query = new EntityFieldQuery();
  $query->entityCondition('entity_type', 'node')
    ->entityCondition('bundle', $bundle_name)
    ->propertyCondition('status', 1)
    ->propertyCondition('language', $language->language);
  return $query;
}

function _tp1_add_term_refenrences_condition($query,$term_field,$term_id){ 
    $query->fieldCondition($term_field, 'tid', array($term_id));
      return $query;
}

function _tp1_query_add_order_by_field($query,$field_order){
  $query->fieldOrderBy($field_order,'value','ASC');
  return $query;
}

function _tp1_get_nodes_id(Array $query_result){
  $node_array = isset($query_result['node'])? $query_result['node']:array();
  $nodes_id = array_keys($node_array);
  return $nodes_id;
}
