<?php
class Store_items extends MX_Controller 
{

function __construct() {
parent::__construct();

$this->load->library('form_validation');
$this->load->library('session');
$this->load->module('site_security');
$this->load->module('templates');
$this->load->module('store_item_colours');
//$this->form_validation->CI =& $this;
}

function _get_item_id_from_item_url($item_url)
{
    $query=$this->get_where_custom('item_url',$item_url);
    foreach($query->result() as $row)
    {
      $item_id=$row->id;
    } 

    if(!isset( $item_id))
    {
        $item_id="";
    }
    return  $item_id;
}

function _process_delete($update_id){
    $this->store_item_colours->_delete_for_item($update_id);
    $big_pic=$data['big_pic'] ;
    $small_pic=$data['small_pic'] ;
    $big_pic_path='./big_pics/'.$big_pic;
    $small_pic_path='./small_pics/'.$small_pic;
    if(file_exists($big_pic_path))
    {
       unlink($big_pic_path);
    }
    if(file_exists($small_pic_path))
    {
      unlink($small_pic_path);
    }
    $this->delete($update_id);
}

function delete(){
    
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();

    $submit=$this->input->post('submit',TRUE);
    
    if(($submit=="cancel"))
    {
      redirect('store_items/create/'.$update_id);
    }elseif($submit=="delete")
    {
       $this->_process_delete($update_id);
       $flash_msg="inserted";
       $value="<div class='alert alert-success fade in'>".$flash_msg."</div>";
       $this->session->set_flashdata('item',$value);
       redirect('store_items/manage/');
    }
   }

function deleteconf($update_id){
    
     if(!is_numeric($update_id))
     { 
         redirect('site_security/not_allowed');
     } 
 
     $this->load->module('site_security');
     $this->site_security->_make_sure_is_admin();
     
     $data['headline'] = "<h1>Delete Item Page</h1>";
     $data['update_id']=$update_id;
     $data['flash']=$this->session->flashdata('item');
     $data['view_file']="deleteconf";
     $this->load->module('templates');
     $this->templates->admin($data);
 
    }

function delete_image($update_id)
{       
    if(!is_numeric($update_id))
    { 
        redirect('site_security/not_allowed');
    }    

    $submit=$this->input->post('submit',TRUE);
    $this->site_security->_make_sure_is_admin();
    $data=$this->fetch_data_from_db($update_id);
    $data['update_id']= $update_id;
    $big_pic=$data['big_pic'] ;
    $small_pic=$data['small_pic'] ;
    $big_pic_path='./big_pics/'.$big_pic;
    $small_pic_path='./small_pics/'.$small_pic;
    if(file_exists($big_pic_path))
    {
       //unlink($big_pic_path);
    }
    if(file_exists($small_pic_path))
    {
     //  unlink($small_pic_path);
    }
    unset($data);
    $data['big_pic']="";
    $data['small_pic']="";
    $this->_update($update_id,$data);

    $data['flash']=$this->session->flashdata('item');
    $data['view_file']="upload_image";
    $this->templates->admin($data);
 
}    

function view($update_id){
    if(!is_numeric($update_id))
    { 
        redirect('site_security/not_allowed');
    }    
    
    $data=$this->fetch_data_from_db($update_id);
    $data['headline'] = "<h1>Upload Error</h1>";
    $data['update_id']= $update_id;
    $data['flash']=$this->session->flashdata('item');
    $data['view_module']="store_items";
    $data['view_file']="view";
    $this->load->module('templates');
    $this->templates->public_bootstrap($data);

}

function _generate_thumbnail($file_name)
{
    $config['image_library'] = 'gd2';
    $config['source_image'] = './big_pics/'.$file_name;
    $config['new_image'] = './small_pics/'.$file_name;
    $config['maintain_ratio'] = TRUE;
    $config['width']         = 200;
    $config['height']       = 200;
    
    $this->load->library('image_lib', $config);
    
    $this->image_lib->resize();
}

function do_upload($update_id)
 {       
    if(!is_numeric($update_id))
    { 
        redirect('site_security/not_allowed');
    }    

    $data['update_id']= $update_id;
    $submit=$this->input->post('submit',TRUE);
    $this->site_security->_make_sure_is_admin();
      
    if(($submit=="cancel"))
    {
      redirect('store_items/create/'.$update_id);
    }
    if(($submit=="submit"))
    {}

        $config['upload_path']          = './big_pics/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1024;
        $config['max_width']            = 5024;
        $config['max_height']           = 5024;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile'))
        {
                $data['error'] = array('error' => $this->upload->display_errors());
                $data['headline'] = "<h1>Upload Error</h1>";
                $data['flash']=$this->session->flashdata('item');
                $data['view_file']="upload_image";
                $this->templates->admin($data);
        }
        else
        {        $data = array('upload_data' => $this->upload->data());
                $upload_data=$data['upload_data'];
                $file_name=$upload_data['file_name'];
                $this->_generate_thumbnail($file_name);
                //Update database
                $update_data['big_pic']=$file_name;
                $update_data['small_pic']=$file_name;
                $this->_update($update_id,$update_data);
                $data['headline'] = "<h1>Upload Success</h1>";
                $data['flash']=$this->session->flashdata('item');
                $data['view_file']="upload_success";
                $this->templates->admin($data);
          
        }
   
}


function upload_image($update_id=""){
    
    if(!is_numeric($update_id))
    { 
        redirect('site_security/not_allowed');
    }    
    $data['update_id']= $update_id;
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $data['headline'] = "<h1>Upload Image </h1>";
    $data['flash']=$this->session->flashdata('item');
    $data['view_file']="upload_image";
    $this->load->module('templates');
    $this->templates->admin($data);

   }

function create(){
    
    
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $update_id=$this->uri->segment(3);
    $submit=$this->input->post('submit',TRUE);
    
    if(($submit=="cancel"))
    {
      redirect('store_items/manage/');
    }
    if(($submit=="submit"))
    {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('item_title','Item Title','required|max_length[240]');
       $this->form_validation->set_rules('item_price','Item Price','required|numeric');
       $this->form_validation->set_rules('was_price','was Price','numeric');
       $this->form_validation->set_rules('item_description','Item Description','required|max_length[5000]');
       $this->form_validation->set_rules('status','Status','required|numeric');

       if($this->form_validation->run()==TRUE)
       {
        $data=$this->fetch_data_from_post();
        $data['item_url']=url_title( $data['item_title'] );
        if(is_numeric( $update_id)){
           $this->_update($update_id, $data);
           $flash_msg="item data updated successfully";
           $value="<div class='alert alert-success fade in'>".$flash_msg."</div>";
           $this->session->set_flashdata('item',$value);
           redirect('store_items/create/'.$update_id);
        }
        else{
            $this->_insert($data);
            $update_id=$this->get_max();//get the id of new item
            $this->load->library('session');
            $flash_msg="item data inserted successfully";
            $value="<div class='alert alert-success fade in'>".$flash_msg."</div>";
            $this->session->set_flashdata('item',$value);
            redirect('store_items/create/'.$update_id);
        }
       }
    }

    if(is_numeric( $update_id) && ($submit!="submit"))
    {
        $data=$this->fetch_data_from_db($update_id);
    }
    else{
        $data=$this->fetch_data_from_post();
        $data['big_pic']="";
    }

    if(!is_numeric( $update_id))
    {
        $data['headline'] = "<h1>Add new item</h1>";
    }
    else{
        $data['headline'] = "<h1>Update Item details </h1>";
    }

    $data['update_id']= $update_id;
    $data['flash']=$this->session->flashdata('item');
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);


   }

function manage(){
    
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $data['flash']=$this->session->flashdata('item');
    
    $data['query']=$this->get('item_title');
    $data['view_file']="manage";
    $this->load->module('templates');
    $this->templates->admin($data);

   }

function fetch_data_from_post()
   {
    $data['item_title']=$this->input->post('item_title',TRUE);
    $data['item_price']=$this->input->post('item_price',TRUE);
    $data['was_price']=$this->input->post('was_price',TRUE);
    $data['item_description']=$this->input->post('item_description',TRUE);
    $data['status']=$this->input->post('status',TRUE);
   // $data['big_pic']=$this->input->post('big_pic',TRUE);

    return $data;
   }

   function fetch_data_from_db($update_id)
   {   

    if(!is_numeric($update_id))
    { 
        redirect('site_security/not_allowed');
    }  
       $query=$this->get_where($update_id);
       foreach($query->result() as $row)
       {
        $data['item_title']       =$row->item_title;
        $data['item_url']          =$row->item_url;
        $data['item_price']        =$row->item_price;
        $data['item_description']  =$row->item_description;
        $data['big_pic']           =$row->big_pic;
        $data['small_pic']         =$row->small_pic;
        $data['was_price']         =$row->was_price;
        $data['status']            =$row->status;

       }   

       if(!isset($data))
       {
           $data="";
       }

       return $data;
   }
function get($order_by)
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_items');
    $count = $this->mdl_store_items->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_items');
    $max_id = $this->mdl_store_items->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->_custom_query($mysql_query);
    return $query;
}

public function item_check($str)
{
        if ($str == 'test')
        {
                $this->form_validation->set_message('item_check', 'The {field} field can not be the word "test"');
                return FALSE;
        }
        else
        {
                return TRUE;
        }
}


}