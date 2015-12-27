<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'bannercats',
  'fields' => 
  array (
    0 => 'id',
    1 => 'position',
    2 => 'name',
    3 => 'name_none',
    4 => 'updated',
    5 => 'created',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Tên danh mục',
      'rules' => 
      array (
        0 => 'trim',
        'max_length' => 200,
      ),
      'field' => 'name',
    ),
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
    'name_none' => 
    array (
      'field' => 'name_none',
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
    'created' => 
    array (
      'field' => 'created',
      'rules' => 
      array (
      ),
    ),
    'banner' => 
    array (
      'field' => 'banner',
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
    'banner' => 
    array (
      'class' => 'banner',
      'other_field' => 'bannercat',
      'join_self_as' => 'bannercat',
      'join_other_as' => 'banner',
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