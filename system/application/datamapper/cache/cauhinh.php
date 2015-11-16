<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'cauhinhs',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'fieldname',
    3 => 'value',
    4 => 'description',
    5 => 'created',
    6 => 'updated',
    7 => 'configgroup_id',
    8 => 'type',
    9 => 'choice_list',
    10 => 'for_webmaster',
    11 => 'style',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Name',
      'rules' => 
      array (
        0 => 'required',
        1 => 'trim',
      ),
      'field' => 'name',
    ),
    'value' => 
    array (
      'label' => 'Value',
      'rules' => 
      array (
        0 => 'trim',
      ),
      'field' => 'value',
    ),
    'fieldname' => 
    array (
      'label' => 'Fieldname',
      'rules' => 
      array (
        0 => 'required',
        1 => 'trim',
      ),
      'field' => 'fieldname',
    ),
    'id' => 
    array (
      'field' => 'id',
      'rules' => 
      array (
        0 => 'integer',
      ),
    ),
    'description' => 
    array (
      'field' => 'description',
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
    'configgroup_id' => 
    array (
      'field' => 'configgroup_id',
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
    'choice_list' => 
    array (
      'field' => 'choice_list',
      'rules' => 
      array (
      ),
    ),
    'for_webmaster' => 
    array (
      'field' => 'for_webmaster',
      'rules' => 
      array (
      ),
    ),
    'style' => 
    array (
      'field' => 'style',
      'rules' => 
      array (
      ),
    ),
    'configgroup' => 
    array (
      'field' => 'configgroup',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'configgroup' => 
    array (
      'class' => 'configgroup',
      'other_field' => 'cauhinh',
      'join_self_as' => 'cauhinh',
      'join_other_as' => 'configgroup',
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