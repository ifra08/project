
<?= $headline?>
<?php echo validation_errors('<div style="color:red;">', '</div>'); 
		 if(isset($flash))
		 {
			 echo $flash;
		 }
		
		 if(is_numeric($item_id))
		 {}
?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Assigned Categories</h2>
						<div class="box-icon">
		                    <p>Submit new option</p>
                            <?php 
                             $url_location=base_url()."store_cat_assign/submit/".$item_id; ?></p>
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal" method="post" action="<?=$url_location?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">New Option</label>
							  <div class="controls">
                              <?php 
								  $parent_cat_id=" ";
                  $additional_dd_code='id="selectError3"';
						      echo form_dropdown('cat_id', $options,$cat_id,$additional_dd_code);
									 
								?>

							</div>
							</div>
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
							  <button type="submit" class="btn" name="submit" value="finished">Finished</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
</div><!--/row-->

<?php 
if($num_rows >0){
?>
<div class="row-fluid sortable">		
<div class="box span12">
    <div class="box-header" data-original-title>
        <h2><i class="halflings-icon white tag"></i><span class="break"></span>Existing Colour Option</h2>
        <div class="box-icon">
            <a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
            <a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
            <a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
        </div>
    </div>
    <div class="box-content">
        <table class="table table-striped table-bordered bootstrap-datatable datatable">
          <thead>
              <tr>
                  <th>Count</th>
                  <th>Colour</th>
                  <th>Actions</th>
              </tr>
          </thead>   
          <tbody>
        <?php     
           $count=0;
           $this->load->module('site_security');
        foreach($query->result() as $row)
                    { 
                       $count++;
                        $delete_url=base_url()."store_cat_assign/delete/". $row->id;  
                        $cat_title=$this->store_categories->_get_cat_title($row->cat_id);  
                        $parent_cat_title=$this->store_categories->_get_parent_cat_title($row->cat_id);
                        $long_cat_title=$parent_cat_title." > ".$cat_title;    
           ?>
            <tr>
                <td><?= $count ?></td>
                <td class="center"><?= $long_cat_title?></td>
                <td class="center">
                    <a class="btn btn-danger" href="<?=$delete_url?>">
                        <i class="halflings-icon white trash"></i>Remove Option 
                    </a>
                </td>
            </tr>
            <?php } ?>
            
          </tbody>
      </table>            
    </div>
</div><!--/span-->

</div>
<?php }?>