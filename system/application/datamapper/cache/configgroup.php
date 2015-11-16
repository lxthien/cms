<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'configgroups',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'created',
    3 => 'updated',
    4 => 'position',
    5 => 'for_webmaster',
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
    'for_webmaster' => 
    array (
      'field' => 'for_webmaster',
      'rules' => 
      array (
      ),
    ),
    'cauhinh' => 
    array (
      'field' => 'cauhinh',
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
    'cauhinh' => 
    array (
      'class' => 'cauhinh',
      'other_field' => 'configgroup',
      'join_self_as' => 'configgroup',
      'join_other_as' => 'cauhinh',
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