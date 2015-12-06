<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'sitelanguages',
  'fields' => 
  array (
    0 => 'id',
    1 => 'position',
    2 => 'short',
    3 => 'name',
    4 => 'color',
    5 => 'created',
    6 => 'updated',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Tên ngôn ngữ',
      'rules' => 
      array (
        0 => 'required',
        1 => 'trim',
      ),
      'field' => 'name',
    ),
    'short' => 
    array (
      'label' => 'shorthand',
      'rules' => 
      array (
        0 => 'trim',
      ),
      'field' => 'short',
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
    'color' => 
    array (
      'field' => 'color',
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
  ),
  'has_one' => 
  array (
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