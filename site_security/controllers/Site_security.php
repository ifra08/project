<?php
class Site_security extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _hash_string($str){
    $hash_string=password_hash($str,PASSWORD_BCRYPT,array('cost'=>11));
    return $hash_string;
}

function _verify_hash($plain_text_str,$hashed_string)
{
    $result=password_verify($plain_text_str,$hashed_string);
    return $result;
}

function _make_sure_is_admin(){
    
    $is_admin=TRUE;

    if($is_admin!=TRUE)
    {
      redirect("Site_security/not_allowed");
    }
   }

   function not_allowed()
   {
       echo "not_allowed";
   }

}