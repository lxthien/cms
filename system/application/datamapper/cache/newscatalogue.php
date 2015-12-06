<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'newscatalogues',
  'fields' => 
  array (
    0 => 'id',
    1 => 'old',
    2 => 'position',
    3 => 'parentcat_id',
    4 => 'name_vietnamese',
    5 => 'name_english',
    6 => 'description',
    7 => 'image',
    8 => 'group',
    9 => 'show',
    10 => 'name_none',
    11 => 'recycle',
    12 => 'title_bar',
    13 => 'slogan',
    14 => 'keyword',
    15 => 'navigation',
    16 => 'menu_active',
    17 => 'isSystem',
    18 => 'created',
    19 => 'updated',
  ),
  'validation' => 
  array (
    'name_vietnamese' => 
    array (
      'label' => 'Tên danh mục',
      'rules' => 
      array (
        0 => 'trim',
        'max_length' => 200,
      ),
      'field' => 'name_vietnamese',
    ),
    'name_english' => 
    array (
      'label' => 'Tên danh mục tiếng anh',
      'rules' => 
      array (
        0 => 'trim',
        'max_length' => 200,
      ),
      'field' => 'name_english',
    ),
    'name_none' => 
    array (
      'label' => 'Tên ko d?u',
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
    'old' => 
    array (
      'field' => 'old',
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
    'parentcat_id' => 
    array (
      'field' => 'parentcat_id',
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
    'image' => 
    array (
      'field' => 'image',
      'rules' => 
      array (
      ),
    ),
    'group' => 
    array (
      'field' => 'group',
      'rules' => 
      array (
      ),
    ),
    'show' => 
    array (
      'field' => 'show',
      'rules' => 
      array (
      ),
    ),
    'recycle' => 
    array (
      'field' => 'recycle',
      'rules' => 
      array (
      ),
    ),
    'title_bar' => 
    array (
      'field' => 'title_bar',
      'rules' => 
      array (
      ),
    ),
    'slogan' => 
    array (
      'field' => 'slogan',
      'rules' => 
      array (
      ),
    ),
    'keyword' => 
    array (
      'field' => 'keyword',
      'rules' => 
      array (
      ),
    ),
    'navigation' => 
    array (
      'field' => 'navigation',
      'rules' => 
      array (
      ),
    ),
    'menu_active' => 
    array (
      'field' => 'menu_active',
      'rules' => 
      array (
      ),
    ),
    'isSystem' => 
    array (
      'field' => 'isSystem',
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
    'parentcat' => 
    array (
      'field' => 'parentcat',
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
    'child' => 
    array (
      'field' => 'child',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'parentcat' => 
    array (
      'class' => 'newscatalogue',
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
      'class' => 'newscatalogue',
      'other_field' => 'parentcat',
      'join_self_as' => 'parentcat',
      'join_other_as' => 'child',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'article' => 
    array (
      'class' => 'article',
      'other_field' => 'newscatalogue',
      'join_self_as' => 'newscatalogue',
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