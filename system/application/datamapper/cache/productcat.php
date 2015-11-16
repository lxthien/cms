<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
$cache = array (
  'table' => 'productcats',
  'fields' => 
  array (
    0 => 'id',
    1 => 'position',
    2 => 'name',
    3 => 'logo',
    4 => 'url',
    5 => 'parentcat_id',
    6 => 'seo_title',
    7 => 'seo_keyword',
    8 => 'seo_description',
    9 => 'created',
    10 => 'updated',
    11 => 'isShowInHot',
    12 => 'isShowInNew',
    13 => 'isShowInParentHot',
    14 => 'image',
    15 => 'numProductHomepage',
    16 => 'isShowLogo',
    17 => 'isHide',
    18 => 'tag',
    19 => 'txtAbout',
    20 => 'txtExterior',
    21 => 'txtInterior',
    22 => 'txtOperation',
    23 => 'txtColor',
    24 => 'txtVideo',
    25 => 'txtSpecification',
    26 => 'txtAccessories',
  ),
  'validation' => 
  array (
    'name' => 
    array (
      'label' => 'Tên danh mục',
      'rules' => 
      array (
        0 => 'trim',
        'max_length' => 200,
      ),
      'field' => 'name',
    ),
    'url' => 
    array (
      'label' => 'url',
      'rules' => 
      array (
        0 => 'trim',
        1 => 'unique',
      ),
      'field' => 'url',
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
    'logo' => 
    array (
      'field' => 'logo',
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
    'seo_title' => 
    array (
      'field' => 'seo_title',
      'rules' => 
      array (
      ),
    ),
    'seo_keyword' => 
    array (
      'field' => 'seo_keyword',
      'rules' => 
      array (
      ),
    ),
    'seo_description' => 
    array (
      'field' => 'seo_description',
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
    'isShowInHot' => 
    array (
      'field' => 'isShowInHot',
      'rules' => 
      array (
      ),
    ),
    'isShowInNew' => 
    array (
      'field' => 'isShowInNew',
      'rules' => 
      array (
      ),
    ),
    'isShowInParentHot' => 
    array (
      'field' => 'isShowInParentHot',
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
    'numProductHomepage' => 
    array (
      'field' => 'numProductHomepage',
      'rules' => 
      array (
      ),
    ),
    'isShowLogo' => 
    array (
      'field' => 'isShowLogo',
      'rules' => 
      array (
      ),
    ),
    'isHide' => 
    array (
      'field' => 'isHide',
      'rules' => 
      array (
      ),
    ),
    'tag' => 
    array (
      'field' => 'tag',
      'rules' => 
      array (
      ),
    ),
    'txtAbout' => 
    array (
      'field' => 'txtAbout',
      'rules' => 
      array (
      ),
    ),
    'txtExterior' => 
    array (
      'field' => 'txtExterior',
      'rules' => 
      array (
      ),
    ),
    'txtInterior' => 
    array (
      'field' => 'txtInterior',
      'rules' => 
      array (
      ),
    ),
    'txtOperation' => 
    array (
      'field' => 'txtOperation',
      'rules' => 
      array (
      ),
    ),
    'txtColor' => 
    array (
      'field' => 'txtColor',
      'rules' => 
      array (
      ),
    ),
    'txtVideo' => 
    array (
      'field' => 'txtVideo',
      'rules' => 
      array (
      ),
    ),
    'txtSpecification' => 
    array (
      'field' => 'txtSpecification',
      'rules' => 
      array (
      ),
    ),
    'txtAccessories' => 
    array (
      'field' => 'txtAccessories',
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
    'product' => 
    array (
      'field' => 'product',
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
    'productcatspec' => 
    array (
      'field' => 'productcatspec',
      'rules' => 
      array (
      ),
    ),
    'producthome' => 
    array (
      'field' => 'producthome',
      'rules' => 
      array (
      ),
    ),
  ),
  'has_one' => 
  array (
    'parentcat' => 
    array (
      'class' => 'productcat',
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
      'class' => 'productcat',
      'other_field' => 'parentcat',
      'join_self_as' => 'parentcat',
      'join_other_as' => 'child',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'product' => 
    array (
      'class' => 'product',
      'other_field' => 'productcat',
      'join_self_as' => 'productcat',
      'join_other_as' => 'product',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'productcatspec' => 
    array (
      'class' => 'productcatspec',
      'other_field' => 'productcat',
      'join_self_as' => 'productcat',
      'join_other_as' => 'productcatspec',
      'join_table' => '',
      'reciprocal' => false,
      'auto_populate' => NULL,
      'cascade_delete' => true,
    ),
    'producthome' => 
    array (
      'class' => 'producthome',
      'other_field' => 'productcat',
      'join_self_as' => 'productcat',
      'join_other_as' => 'producthome',
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