<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'menus',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'link',
    3 => 'created',
    4 => 'updated',
    5 => 'position',
    6 => 'active',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Tên menu cha',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'required',
      ),
      'field' => 'name',
    ),
    'link' => 
    array (
      'label' => 'Liên kết Menu cha',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'required',
      ),
      'field' => 'link',
    ),
    'id' => 
    array (
      'field' => 'id',
      'rules' => 
      array (
        0 => 'integer',
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
    'position' => 
    array (
      'field' => 'position',
      'rules' => 
      array (
      ),
    ),
    'active' => 
    array (
      'field' => 'active',
      'rules' => 
      array (
      ),
    ),
    'menuitem' => 
    array (
      'field' => 'menuitem',
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
    'menuitem' => 
    array (
      'class' => 'menuitem',
      'other_field' => 'menu',
      'join_self_as' => 'menu',
      'join_other_as' => 'menuitem',
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