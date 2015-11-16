<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'adminusers',
  'fields' => 
  array (
    0 => 'id',
    1 => 'username',
    2 => 'adminrole_id',
    3 => 'password',
    4 => 'active',
    5 => 'recycle',
    6 => 'email',
    7 => 'fullname',
    8 => 'phone',
    9 => 'address',
    10 => 'created',
    11 => 'updated',
    12 => 'kfm_username',
    13 => 'ktfm_password',
  ),
  'validation' => 
  array (
    'username' => 
    array (
      'label' => 'Ðịa chỉ email',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'unique',
        'max_length' => 255,
      ),
      'field' => 'username',
    ),
    'password' => 
    array (
      'label' => 'Mật khẩu',
      'rules' => 
      array (
        0 => 'required',
        1 => 'trim',
        'min_length' => 6,
        'max_length' => 100,
        2 => 'encrypt',
      ),
      'field' => 'password',
    ),
    'confirm_password' => 
    array (
      'label' => 'Nhập lại mật khẩu',
      'rules' => 
      array (
        0 => 'encrypt',
        1 => 'trim',
        'matches' => 'password',
      ),
      'field' => 'confirm_password',
    ),
    'fullname' => 
    array (
      'label' => 'Tên người dùng',
      'rules' => 
      array (
        0 => 'trim',
        'max_length' => 100,
      ),
      'field' => 'fullname',
    ),
    'address' => 
    array (
      'label' => 'Địa chỉ',
      'rules' => 
      array (
        0 => 'trim',
      ),
      'field' => 'address',
    ),
    'phone' => 
    array (
      'label' => 'Điện thoại',
      'rules' => 
      array (
        0 => 'trim',
      ),
      'field' => 'phone',
    ),
    'adminrole' => 
    array (
      'label' => 'Nhóm',
      'rules' => 
      array (
        0 => 'required',
      ),
      'field' => 'adminrole',
    ),
    'id' => 
    array (
      'field' => 'id',
      'rules' => 
      array (
        0 => 'integer',
      ),
    ),
    'adminrole_id' => 
    array (
      'field' => 'adminrole_id',
      'rules' => 
      array (
      ),
    ),
    'active' => 
    array (
      'field' => 'active',
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
    'email' => 
    array (
      'field' => 'email',
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
    'kfm_username' => 
    array (
      'field' => 'kfm_username',
      'rules' => 
      array (
      ),
    ),
    'ktfm_password' => 
    array (
      'field' => 'ktfm_password',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'adminrole' => 
    array (
      'class' => 'adminrole',
      'other_field' => 'adminuser',
      'join_self_as' => 'adminuser',
      'join_other_as' => 'adminrole',
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
      'confirm_password' => 'password',
    ),
    'intval' => 
    array (
      0 => 'id',
    ),
  ),
);