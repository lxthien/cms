<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'contact',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'title',
    3 => 'hotline',
    4 => 'phone',
    5 => 'sex',
    6 => 'address',
    7 => 'email',
    8 => 'content',
    9 => 'created',
    10 => 'updated',
    11 => 'cat',
    12 => 'catalog',
    13 => 'price_lending',
    14 => 'time_lending',
    15 => 'name_company',
    16 => 'address_company',
    17 => 'content_company',
  ),
  'validation' => 
  array (
    'title' => 
    array (
      'label' => 'Tiêu đề',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'required',
      ),
      'field' => 'title',
    ),
    'name' => 
    array (
      'label' => 'Tên',
      'rules' => 
      array (
        0 => 'trim',
        'max_length' => 200,
        1 => 'required',
      ),
      'field' => 'name',
    ),
    'phone' => 
    array (
      'label' => 'Điện thoại',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'required',
        'max_length' => 200,
      ),
      'field' => 'phone',
    ),
    'email' => 
    array (
      'label' => 'Địa chỉ email',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'required',
        2 => 'email',
      ),
      'field' => 'email',
    ),
    'id' => 
    array (
      'field' => 'id',
      'rules' => 
      array (
        0 => 'integer',
      ),
    ),
    'hotline' => 
    array (
      'field' => 'hotline',
      'rules' => 
      array (
      ),
    ),
    'sex' => 
    array (
      'field' => 'sex',
      'rules' => 
      array (
      ),
    ),
    'address' => 
    array (
      'field' => 'address',
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
    'cat' => 
    array (
      'field' => 'cat',
      'rules' => 
      array (
      ),
    ),
    'catalog' => 
    array (
      'field' => 'catalog',
      'rules' => 
      array (
      ),
    ),
    'price_lending' => 
    array (
      'field' => 'price_lending',
      'rules' => 
      array (
      ),
    ),
    'time_lending' => 
    array (
      'field' => 'time_lending',
      'rules' => 
      array (
      ),
    ),
    'name_company' => 
    array (
      'field' => 'name_company',
      'rules' => 
      array (
      ),
    ),
    'address_company' => 
    array (
      'field' => 'address_company',
      'rules' => 
      array (
      ),
    ),
    'content_company' => 
    array (
      'field' => 'content_company',
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