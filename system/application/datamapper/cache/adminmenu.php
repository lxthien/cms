<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'adminmenus',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'link',
    3 => 'icon',
    4 => 'position',
    5 => 'class',
    6 => 'li_class',
    7 => 'created',
    8 => 'updated',
    9 => 'parentmenu_id',
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
    'link' => 
    array (
      'label' => 'Liên kết đến',
      'rules' => 
      array (
        0 => 'trim',
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
    'icon' => 
    array (
      'field' => 'icon',
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
    'class' => 
    array (
      'field' => 'class',
      'rules' => 
      array (
      ),
    ),
    'li_class' => 
    array (
      'field' => 'li_class',
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
    'parentmenu_id' => 
    array (
      'field' => 'parentmenu_id',
      'rules' => 
      array (
      ),
    ),
    'parentmenu' => 
    array (
      'field' => 'parentmenu',
      'rules' => 
      array (
      ),
    ),
    'child' => 
    array (
      'field' => 'child',
      'rules' => 
      array (
      ),
    ),
    'adminrole' => 
    array (
      'field' => 'adminrole',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'parentmenu' => 
    array (
      'class' => 'adminmenu',
      'other_field' => 'child',
      'join_self_as' => 'child',
      'join_other_as' => 'parentmenu',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
  ),
  'has_many' => 
  array (
    'child' => 
    array (
      'class' => 'adminmenu',
      'other_field' => 'parentmenu',
      'join_self_as' => 'parentmenu',
      'join_other_as' => 'child',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'adminrole' => 
    array (
      'class' => 'adminrole',
      'other_field' => 'adminmenu',
      'join_self_as' => 'adminmenu',
      'join_other_as' => 'adminrole',
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