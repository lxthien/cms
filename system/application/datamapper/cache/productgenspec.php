<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'productgenspecs',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'position',
    3 => 'description',
    4 => 'parentcat_id',
    5 => 'isNewtabs',
    6 => 'isGroup',
    7 => 'updated',
    8 => 'created',
    9 => 'type',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Tên thu?c tính',
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
    'description' => 
    array (
      'field' => 'description',
      'rules' => 
      array (
      ),
    ),
    'parentcat_id' => 
    array (
      'field' => 'parentcat_id',
      'rules' => 
      array (
      ),
    ),
    'isNewtabs' => 
    array (
      'field' => 'isNewtabs',
      'rules' => 
      array (
      ),
    ),
    'isGroup' => 
    array (
      'field' => 'isGroup',
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
    'type' => 
    array (
      'field' => 'type',
      'rules' => 
      array (
      ),
    ),
    'parentcat' => 
    array (
      'field' => 'parentcat',
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
    'productcatspec' => 
    array (
      'field' => 'productcatspec',
      'rules' => 
      array (
      ),
    ),
    'productspec' => 
    array (
      'field' => 'productspec',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'parentcat' => 
    array (
      'class' => 'productgenspec',
      'other_field' => 'child',
      'join_self_as' => 'child',
      'join_other_as' => 'parentcat',
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
      'class' => 'productgenspec',
      'other_field' => 'parentcat',
      'join_self_as' => 'parentcat',
      'join_other_as' => 'child',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'productcatspec' => 
    array (
      'class' => 'productcatspec',
      'other_field' => 'productgenspec',
      'join_self_as' => 'productgenspec',
      'join_other_as' => 'productcatspec',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'productspec' => 
    array (
      'class' => 'productspec',
      'other_field' => 'productgenspec',
      'join_self_as' => 'productgenspec',
      'join_other_as' => 'productspec',
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