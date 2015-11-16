<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'banners',
  'fields' => 
  array (
    0 => 'id',
    1 => 'position',
    2 => 'link',
    3 => 'name',
    4 => 'image',
    5 => 'width',
    6 => 'height',
    7 => 'bannercat_id',
    8 => 'isCanNotDelete',
    9 => 'created',
    10 => 'updated',
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
    'position' => 
    array (
      'field' => 'position',
      'rules' => 
      array (
      ),
    ),
    'link' => 
    array (
      'field' => 'link',
      'rules' => 
      array (
      ),
    ),
    'name' => 
    array (
      'field' => 'name',
      'rules' => 
      array (
      ),
    ),
    'image' => 
    array (
      'field' => 'image',
      'rules' => 
      array (
      ),
    ),
    'width' => 
    array (
      'field' => 'width',
      'rules' => 
      array (
      ),
    ),
    'height' => 
    array (
      'field' => 'height',
      'rules' => 
      array (
      ),
    ),
    'bannercat_id' => 
    array (
      'field' => 'bannercat_id',
      'rules' => 
      array (
      ),
    ),
    'isCanNotDelete' => 
    array (
      'field' => 'isCanNotDelete',
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
    'bannercat' => 
    array (
      'field' => 'bannercat',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'bannercat' => 
    array (
      'class' => 'bannercat',
      'other_field' => 'banner',
      'join_self_as' => 'banner',
      'join_other_as' => 'bannercat',
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