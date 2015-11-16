<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'productphotos',
  'fields' => 
  array (
    0 => 'id',
    1 => 'path',
    2 => 'filename',
    3 => 'caption',
    4 => 'product_id',
    5 => 'created',
    6 => 'updated',
    7 => 'isDefault',
    8 => 'position',
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
    'path' => 
    array (
      'field' => 'path',
      'rules' => 
      array (
      ),
    ),
    'filename' => 
    array (
      'field' => 'filename',
      'rules' => 
      array (
      ),
    ),
    'caption' => 
    array (
      'field' => 'caption',
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
    'isDefault' => 
    array (
      'field' => 'isDefault',
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
    'product' => 
    array (
      'class' => 'product',
      'other_field' => 'productphoto',
      'join_self_as' => 'productphoto',
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