<?php
class Store_accounts extends MX_Controller 
{

function __construct() {
parent::__construct();

$this->load->library('form_validation');
$this->load->library('session');
$this->load->module('site_security');
$this->load->module('templates');
$this->load->module('store_item_colours');
}

function update_pword(){
    
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $update_id=$this->uri->segment(3);
    $submit=$this->input->post('submit',TRUE);
    
    if(!is_numeric( $update_id))
    {
        redirect('store_accounts/manage/');
    }

    elseif(($submit=="cancel"))
    {
      redirect('store_accounts/create/'.$update_id);
    }
    if(($submit=="submit"))
    {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('pword','Password','required|min_length[5]|max_length[12]');
       $this->form_validation->set_rules('repeat_pword','Password','required|matches[pword]');
       
       if($this->form_validation->run()==TRUE)
       {
        $pword=$this->input->post('pword',TRUE);
        $data['pword']=$this->site_security->_hash_string($pword);
           $this->_update($update_id, $data);
           $flash_msg="password updated";
           $value="<div class='alert alert-success fade in'>".$flash_msg."</div>";
           $this->session->set_flashdata('account',$value);
           redirect('store_accounts/create/'.$update_id);
        
       }
    }

    if(is_numeric( $update_id) && ($submit!="submit"))
    {
        $data=$this->fetch_data_from_db($update_id);
    }
    else{
        $data=$this->fetch_data_from_post();
           }
        $data['headline'] = "<h1>password updated</h1>";
   
    $data['update_id']= $update_id;
    $data['flash']=$this->session->flashdata('account');
    $data['view_file']="update_pword";
    $this->load->module('templates');
    $this->templates->admin($data);


   }

function autogen(){
    $mysql_query="show columns from store_accounts";
    $query=$this->_custom_query($mysql_query);
    foreach($query->result() as $row)
    {
        $column_name=$row->Field;
        if( $column_name!="id")
        {
         echo   '$data[\''.$column_name.'\']=$this->input->post(\''.$column_name.'\',TRUE);<br>';
        }
    }
    
    echo "<hr>";

    foreach($query->result() as $row)
    {
        $column_name=$row->Field;
        if( $column_name!="id")
        {
         echo   '$data[\''.$column_name.'\']=$row->'.$column_name.';<br>';
        }
    }

    echo "<hr>";
    
        foreach($query->result() as $row)
        {
            $column_name=$row->Field;
            if( $column_name!="id")
            {
                $var='<div class="control-group">
                <label class="control-label" for="typeahead">'.ucfirst($column_name).'</label>
                <div class="controls">
                  <input type="text" class="span6"  name="'.$column_name.'" value="<?= $'.$column_name.' ?>">
              </div>
              </div>';

              echo htmlentities($var);
              echo "<br><br>";
            }
        }
    

}

function fetch_data_from_post()
{
    $data['firstname']=$this->input->post('firstname',TRUE);
    $data['lastname']=$this->input->post('lastname',TRUE);
    $data['company']=$this->input->post('company',TRUE);
    $data['address1']=$this->input->post('address1',TRUE);
    $data['address2']=$this->input->post('address2',TRUE);
    $data['town']=$this->input->post('town',TRUE);
    $data['country']=$this->input->post('country',TRUE);
    $data['postcode']=$this->input->post('postcode',TRUE);
    $data['telnum']=$this->input->post('telnum',TRUE);
    $data['email']=$this->input->post('email',TRUE);
    $data['date_made']=$this->input->post('date_made',TRUE);
    $data['pword']=$this->input->post('pword',TRUE);

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
        $data['firstname']=$row->firstname;
        $data['lastname']=$row->lastname;
        $data['company']=$row->company;
        $data['address1']=$row->address1;
        $data['address2']=$row->address2;
        $data['town']=$row->town;
        $data['country']=$row->country;
        $data['postcode']=$row->postcode;
        $data['telnum']=$row->telnum;
        $data['email']=$row->email;
        $data['date_made']=$row->date_made;
        $data['pword']=$row->pword;

    }   

    if(!isset($data))
    {
        $data="";
    }

    return $data;
}
function create(){
    
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $update_id=$this->uri->segment(3);
    $submit=$this->input->post('submit',TRUE);
    
    if(($submit=="cancel"))
    {
      redirect('store_accounts/manage/');
    }
    if(($submit=="submit"))
    {
       $this->load->library('form_validation');
       $this->form_validation->set_rules('firstname','First Name','required');
       
       if($this->form_validation->run()==TRUE)
       {
        $data=$this->fetch_data_from_post();
      //  $data['account_url']=url_title( $data['account_title'] );
        if(is_numeric( $update_id)){
           $this->_update($update_id, $data);
           $flash_msg="updated";
           $value="<div class='alert alert-success fade in'>".$flash_msg."</div>";
           $this->session->set_flashdata('account',$value);
           redirect('store_accounts/create/'.$update_id);
        }
        else{
            $data['date_made']=time();
            $this->_insert($data);
            $update_id=$this->get_max();//get the id of new account
            $this->load->library('session');
            $flash_msg="inserted";
            $value="<div class='alert alert-success fade in'>".$flash_msg."</div>";
            $this->session->set_flashdata('account',$value);
            redirect('store_accounts/create/'.$update_id);
        }
       }
    }

    if(is_numeric( $update_id) && ($submit!="submit"))
    {
        $data=$this->fetch_data_from_db($update_id);
    }
    else{
        $data=$this->fetch_data_from_post();
           }

    if(!is_numeric( $update_id))
    {
        $data['headline'] = "<h1>Add new account</h1>";
    }
    else{
        $data['headline'] = "<h1>Update account details </h1>";
    }

    $data['update_id']= $update_id;
    $data['flash']=$this->session->flashdata('account');
    $data['view_file']="create";
    $this->load->module('templates');
    $this->templates->admin($data);


   }

function manage(){
    
    $this->load->module('site_security');
    $this->site_security->_make_sure_is_admin();
    $data['flash']=$this->session->flashdata('account');
    
    $data['query']=$this->get('lastname');
    $data['view_file']="manage";
    $this->load->module('templates');
    $this->templates->admin($data);

   }

function get($order_by)
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) 
{
    if ((!is_numeric($limit)) || (!is_numeric($offset))) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_where($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_where($id);
    return $query;
}

function get_where_custom($col, $value) 
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->get_where_custom($col, $value);
    return $query;
}

function _insert($data)
{
    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_insert($data);
}

function _update($id, $data)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_update($id, $data);
}

function _delete($id)
{
    if (!is_numeric($id)) {
        die('Non-numeric variable!');
    }

    $this->load->model('mdl_store_accounts');
    $this->mdl_store_accounts->_delete($id);
}

function count_where($column, $value) 
{
    $this->load->model('mdl_store_accounts');
    $count = $this->mdl_store_accounts->count_where($column, $value);
    return $count;
}

function get_max() 
{
    $this->load->model('mdl_store_accounts');
    $max_id = $this->mdl_store_accounts->get_max();
    return $max_id;
}

function _custom_query($mysql_query) 
{
    $this->load->model('mdl_store_accounts');
    $query = $this->mdl_store_accounts->_custom_query($mysql_query);
    return $query;
}

}