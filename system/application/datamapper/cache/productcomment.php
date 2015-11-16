<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'productcomments',
  'fields' => 
  array (
    0 => 'id',
    1 => 'product_id',
    2 => 'title',
    3 => 'name',
    4 => 'email',
    5 => 'phone',
    6 => 'content',
    7 => 'likes',
    8 => 'dislikes',
    9 => 'creationDate',
    10 => 'created',
    11 => 'updated',
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
    'product_id' => 
    array (
      'field' => 'product_id',
      'rules' => 
      array (
      ),
    ),
    'title' => 
    array (
      'field' => 'title',
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
    'email' => 
    array (
      'field' => 'email',
      'rules' => 
      array (
      ),
    ),
    'phone' => 
    array (
      'field' => 'phone',
      'rules' => 
      array (
      ),
    ),
    'content' => 
    array (
      'field' => 'content',
      'rules' => 
      array (
      ),
    ),
    'likes' => 
    array (
      'field' => 'likes',
      'rules' => 
      array (
      ),
    ),
    'dislikes' => 
    array (
      'field' => 'dislikes',
      'rules' => 
      array (
      ),
    ),
    'creationDate' => 
    array (
      'field' => 'creationDate',
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
    'product' => 
    array (
      'field' => 'product',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'product' => 
    array (
      'class' => 'product',
      'other_field' => 'productcomment',
      'join_self_as' => 'productcomment',
      'join_other_as' => 'product',
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