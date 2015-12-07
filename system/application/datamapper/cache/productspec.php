<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'productspecs',
  'fields' => 
  array (
    0 => 'id',
    1 => 'position',
    2 => 'product_id',
    3 => 'productgenspec_id',
    4 => 'value',
    5 => 'created',
    6 => 'updated',
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
    'position' => 
    array (
      'field' => 'position',
      'rules' => 
      array (
      ),
    ),
    'product_id' => 
    array (
      'field' => 'product_id',
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
    'value' => 
    array (
      'field' => 'value',
      'rules' => 
      array (
      ),
    ),
    'created' => 
    array (
      'field' => 'created',
      'rules' => 
      array (
      ),
    ),
    'updated' => 
    array (
      'field' => 'updated',
      'rules' => 
      array (
      ),
    ),
    'product' => 
    array (
      'field' => 'product',
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
    'product' => 
    array (
      'class' => 'product',
      'other_field' => 'productspec',
      'join_self_as' => 'productspec',
      'join_other_as' => 'product',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'productgenspec' => 
    array (
      'class' => 'productgenspec',
      'other_field' => 'productspec',
      'join_self_as' => 'productspec',
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