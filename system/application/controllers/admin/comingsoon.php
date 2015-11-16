<?php
class Comingsoon extends MY_Controller{
    function __construct()
    {
        parent::MY_Controller();
        $this->load->library('login_manager');
    }
    function index()
    {
        $dis['base_url']=base_url();
        $dis['view']="layout/comingsoon";
        $dis['menu_active']="";
        $dis['title']="Coming soon";
        $this->viewadmin($dis);
    }
}