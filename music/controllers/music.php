<?php
class Music extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->module('store_categories');
}

function instruments()
{
    $cat_url=$this->uri->segment(3);
    $cat_id=$this->store_categories->_get_cat_id_from_cat_url($cat_url);
    $this->store_categories->view($cat_id);
}


}