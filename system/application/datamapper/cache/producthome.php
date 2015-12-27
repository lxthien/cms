<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'producthomes',
  'fields' => 
  array (
    0 => 'id',
    1 => 'product_id',
    2 => 'position',
    3 => 'created',
    4 => 'productcat_id',
    5 => 'updated',
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
    'product_id' => 
    array (
      'field' => 'product_id',
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
    'created' => 
    array (
      'field' => 'created',
      'rules' => 
      array (
      ),
    ),
    'productcat_id' => 
    array (
      'field' => 'productcat_id',
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
    'productcat' => 
    array (
      'field' => 'productcat',
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
  ),
  'has_one' => 
  array (
    'productcat' => 
    array (
      'class' => 'productcat',
      'other_field' => 'producthome',
      'join_self_as' => 'producthome',
      'join_other_as' => 'productcat',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'product' => 
    array (
      'class' => 'product',
      'other_field' => 'producthome',
      'join_self_as' => 'producthome',
      'join_other_as' => 'product',
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