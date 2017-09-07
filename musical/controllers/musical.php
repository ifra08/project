<?php
class Musical extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->module('store_items');
}

function instruments()
{
    $item_url=$this->uri->segment(3);
    $item_id=$this->store_items->_get_item_id_from_item_url($item_url);
    $this->store_items->view($item_id);
}


}