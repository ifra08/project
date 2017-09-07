<?php
class Site_setting extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _get_currency_symbol()
{
    $symbol="&pound";
    return $symbol;
}

function _get_item_segments()
{
    $segments="musical/instruments/";
    return $segments;
}

function _get_items_segments()
{
    $segments="music/instruments/";
    return $segments;
}

function _get_page_not_found_msg(){
    $msg ="<h1>NOT available<h1>";
    echo $msg;

}
}