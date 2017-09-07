
<?= $headline?>
<?php echo validation_errors('<div style="color:red;">', '</div>'); 
		 if(isset($flash))
		 {
			 echo $flash;
		 }
		
		 if(is_numeric($update_id))
		 {}
?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>New Colour Option</h2>
						<div class="box-icon">
		                    <p>Submit new option</p>
                            <?php 
                             $url_location=base_url()."store_item_colours/submit/".$update_id; ?></p>
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
								<input type="text" class="span6"  name="colour" >
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
        foreach($query->result() as $row)
                    { 
                       $count++;
                        $delete_url=base_url()."store_item_colours/delete/". $row->id;        
           ?>
            <tr>
                <td><?= $count ?></td>
                <td class="center"><?= $row->colour?></td>
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