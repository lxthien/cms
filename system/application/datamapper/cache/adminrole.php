<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'adminroles',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'level',
    3 => 'created',
    4 => 'updated',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Tên nhóm',
      'rules' => 
      array (
        0 => 'trim',
        'max_length' => 100,
      ),
      'field' => 'name',
    ),
    'level' => 
    array (
      'label' => 'Cấp',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'numeric',
      ),
      'field' => 'level',
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
    'adminuser' => 
    array (
      'field' => 'adminuser',
      'rules' => 
      array (
      ),
    ),
    'adminmenu' => 
    array (
      'field' => 'adminmenu',
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
    'adminuser' => 
    array (
      'class' => 'adminuser',
      'other_field' => 'adminrole',
      'join_self_as' => 'adminrole',
      'join_other_as' => 'adminuser',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'adminmenu' => 
    array (
      'class' => 'adminmenu',
      'other_field' => 'adminrole',
      'join_self_as' => 'adminrole',
      'join_other_as' => 'adminmenu',
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