
<?php echo validation_errors('<div style="color:red;">', '</div>'); 
		 if(isset($flash))
		 {
			 echo $flash;
		 }
		
		
?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Upload Image</h2>
						<div class="box-icon">
		
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                         
                    <?php if(isset($error))
                      {  
						  foreach($error as $value)
						  {
							echo '<div style="color:red;">'.$value.'</div>';
						  }
                        
                      }?>
					<?php
					$attributes = array('class' => 'form-horizontal');
					echo form_open_multipart('store_items/do_upload/'.$update_id,$attributes );
				//	<form class="form-horizontal">
					?>  
					
					      <p>Please choose file</p>
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="fileInput">File input</label>
							  <div class="controls">
								<input class="input-file uniform_on"  name="userfile" id="fileInput" type="file">
							  </div>
							</div>          
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Upload</button>
							  <button type="submit" class="btn" name="submit" value="cancel">Cancel</button>
							</div>
						  </fieldset>
						</form>   


                    <!-- <?php echo form_open_multipart('store_items/do_upload/'.$update_id);?>
                    <input type="file" name="userfile" size="20" />
                    <br /><br />
                    <input type="submit" value="upload" />
                    </form> -->
					</div>
				</div><!--/span-->

			</div><!--/row-->
