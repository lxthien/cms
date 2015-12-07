<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'productcatspecs',
  'fields' => 
  array (
    0 => 'id',
    1 => 'productcat_id',
    2 => 'productgenspec_id',
    3 => 'position',
    4 => 'value',
  ),
  'validation' => 
  array (
    'id' => 
    array (
      'field' => 'id',
      'rules' => 
      array (
        0 => 'integer',
      ),
    ),
    'productcat_id' => 
    array (
      'field' => 'productcat_id',
      'rules' => 
      array (
      ),
    ),
    'productgenspec_id' => 
    array (
      'field' => 'productgenspec_id',
      'rules' => 
      array (
      ),
    ),
    'position' => 
    array (
      'field' => 'position',
      'rules' => 
      array (
      ),
    ),
    'value' => 
    array (
      'field' => 'value',
      'rules' => 
      array (
      ),
    ),
    'productcat' => 
    array (
      'field' => 'productcat',
      'rules' => 
      array (
      ),
    ),
    'productgenspec' => 
    array (
      'field' => 'productgenspec',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'productcat' => 
    array (
      'class' => 'productcat',
      'other_field' => 'productcatspec',
      'join_self_as' => 'productcatspec',
      'join_other_as' => 'productcat',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'productgenspec' => 
    array (
      'class' => 'productgenspec',
      'other_field' => 'productcatspec',
      'join_self_as' => 'productcatspec',
      'join_other_as' => 'productgenspec',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
  ),
  'has_many' => 
  array (
  ),
  '_field_tracking' => 
  array (
    'get_rules' => 
    array (
    ),
    'matches' => 
    array (
    ),
    'intval' => 
    array (
      0 => 'id',
    ),
  ),
);