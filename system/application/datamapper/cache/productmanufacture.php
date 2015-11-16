<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'productmanufactures',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'description',
    3 => 'country',
    4 => 'recycle',
    5 => 'created',
    6 => 'updated',
    7 => 'image',
    8 => 'isShow',
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
    'name' => 
    array (
      'field' => 'name',
      'rules' => 
      array (
      ),
    ),
    'description' => 
    array (
      'field' => 'description',
      'rules' => 
      array (
      ),
    ),
    'country' => 
    array (
      'field' => 'country',
      'rules' => 
      array (
      ),
    ),
    'recycle' => 
    array (
      'field' => 'recycle',
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
    'image' => 
    array (
      'field' => 'image',
      'rules' => 
      array (
      ),
    ),
    'isShow' => 
    array (
      'field' => 'isShow',
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
  ),
  'has_many' => 
  array (
    'product' => 
    array (
      'class' => 'product',
      'other_field' => 'productmanufacture',
      'join_self_as' => 'productmanufacture',
      'join_other_as' => 'product',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
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