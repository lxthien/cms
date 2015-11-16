<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Router extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
    }

	function findRouter() {
		require_once('fnews.php');
		$products = new Fnews();
		$products->test();
	}

}