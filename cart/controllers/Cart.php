<?php
class Cart extends MX_Controller 
{

function __construct() {
parent::__construct();
$this->load->module('Store_item_colours');
//$this->load->module('Store_item_size');
}

function _draw_add_to_cart($item_id){
    //colour option
    $submitted_colour=$this->input->post('submitted_colour',TRUE);
    if($submitted_colour=="")
    {
        $colour_options['']="Select..";
    }

    $query=$this->store_item_colours->get_where_custom('item_id',$item_id);
    $data['num_colours']=$query->num_rows();
           foreach($query->result() as $row){
            $colour_options[$row->id]=$row->colour;
           }
    
    //size option
   // $submitted_size=$this->input->post('submitted_size',TRUE);
    // if($submitted_size=="")
    // {
    //     $colour_options['']="Select..";
    // }

    // $query=$this->store_item_size->get_where_custom('item_id',$item_id);
    // $data['num_size']=$query->num_rows();
    //        foreach($query->result() as $row){
    //         $colour_options[$row->id]=$row->colour;
    //        }       

    // $data['submitted_size']=$submitted_size; 
    $data['submitted_colour']=$submitted_colour;         
    $data['colour_options']=$colour_options;       
    $data['item_id']=$item_id;
    $this->load->view('add_to_cart',$data);

}
}