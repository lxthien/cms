<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'menuitems',
  'fields' => 
  array (
    0 => 'id',
    1 => 'position',
    2 => 'name',
    3 => 'link',
    4 => 'menu_id',
    5 => 'created',
    6 => 'updated',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Tên menu con',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'required',
      ),
      'field' => 'name',
    ),
    'link' => 
    array (
      'label' => 'Liên kết Menu con',
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
    'position' => 
    array (
      'field' => 'position',
      'rules' => 
      array (
      ),
    ),
    'menu_id' => 
    array (
      'field' => 'menu_id',
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
    'menu' => 
    array (
      'field' => 'menu',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'menu' => 
    array (
      'class' => 'menu',
      'other_field' => 'menuitem',
      'join_self_as' => 'menuitem',
      'join_other_as' => 'menu',
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