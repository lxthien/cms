<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'customers',
  'fields' => 
  array (
    0 => 'id',
    1 => 'name',
    2 => 'username',
    3 => 'password',
    4 => 'code',
    5 => 'mobilePhone',
    6 => 'address',
    7 => 'email',
    8 => 'birthday',
    9 => 'emailActiveCode',
    10 => 'active',
    11 => 'position',
    12 => 'created',
    13 => 'updated',
    14 => 'homePhone',
    15 => 'sex',
    16 => 'isReceiverEmail',
    17 => 'isEmailActive',
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
    'username' => 
    array (
      'field' => 'username',
      'rules' => 
      array (
      ),
    ),
    'password' => 
    array (
      'field' => 'password',
      'rules' => 
      array (
      ),
    ),
    'code' => 
    array (
      'field' => 'code',
      'rules' => 
      array (
      ),
    ),
    'mobilePhone' => 
    array (
      'field' => 'mobilePhone',
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
    'email' => 
    array (
      'field' => 'email',
      'rules' => 
      array (
      ),
    ),
    'birthday' => 
    array (
      'field' => 'birthday',
      'rules' => 
      array (
      ),
    ),
    'emailActiveCode' => 
    array (
      'field' => 'emailActiveCode',
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
    'position' => 
    array (
      'field' => 'position',
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
    'homePhone' => 
    array (
      'field' => 'homePhone',
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
    'isReceiverEmail' => 
    array (
      'field' => 'isReceiverEmail',
      'rules' => 
      array (
      ),
    ),
    'isEmailActive' => 
    array (
      'field' => 'isEmailActive',
      'rules' => 
      array (
      ),
    ),
    'cartitem' => 
    array (
      'field' => 'cartitem',
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
    'cartitem' => 
    array (
      'class' => 'cartitem',
      'other_field' => 'customer',
      'join_self_as' => 'customer',
      'join_other_as' => 'cartitem',
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