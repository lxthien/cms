<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'newstopics',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'name_none',
    3 => 'recycle',
    4 => 'created',
    5 => 'updated',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Tên dòng sự kiện',
      'rules' => 
      array (
        0 => 'trim',
        'max_length' => 200,
      ),
      'field' => 'name',
    ),
    'name_none' => 
    array (
      'label' => 'Tên không dấu',
      'rules' => 
      array (
        0 => 'required',
      ),
      'field' => 'name_none',
    ),
    'id' => 
    array (
      'field' => 'id',
      'rules' => 
      array (
        0 => 'integer',
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
    'article' => 
    array (
      'field' => 'article',
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
    'article' => 
    array (
      'class' => 'article',
      'other_field' => 'newstopic',
      'join_self_as' => 'newstopic',
      'join_other_as' => 'article',
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