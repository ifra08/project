
<?= $headline?>
<?php echo validation_errors('<div style="color:red;">', '</div>'); 
		 if(isset($flash))
		 {
			 echo $flash;
		 }
?>

<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>page Details</h2>
						<div class="box-icon">
		
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                    <?php		$form_location=base_url()."webpages/create/".$update_id; ?>
						<form class="form-horizontal" method="post" action="<?=$form_location?>">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">page Title</label>
							  <div class="controls">
								<input type="text" class="span6"  name="page_title" value="<?= $page_title ?>">
							</div>
							</div>

                            <div class="control-group hidden-phone">
							  <label class="control-label" >page Keyword</label>
							  <div class="controls">
								<textarea rows="3" class="span6" name="page_keywords">
                                <?=  $page_keywords ?></textarea>
							  </div>
							</div>

                            <div class="control-group hidden-phone">
							  <label class="control-label" >page Description</label>
							  <div class="controls">
								<textarea rows="3" class="span6" name="page_description">
                                <?=  $page_description ?></textarea>
							  </div>
							</div>
				     
							<div class="control-group">
                            <label class="control-label" for="typeahead">Page Headline</label>
                            <div class="controls">
                              <input type="text" class="span6"  name="page_headline" value="<?= $page_headline ?>">
                          </div>
                          </div>

                          <div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">page Content</label>
							  <div class="controls">
								<textarea class="cleditor" id="textarea2" rows="3"
								name="page_content"><?=  $page_content?></textarea>
							  </div>
							</div>

						  
							<div class="form-actions">
							  <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
							  <button type="submit" class="btn" name="submit" value="cancel">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->

			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon white edit"></i><span class="break"></span>Additional Option</h2>
						<div class="box-icon">
		
							<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<?php 
					if($update_id>2){ ?>
							 <a href="<?php echo base_url() ?>webpages/deleteconf/<?= $update_id?>"><button type="button" class="btn btn-danger" name="submit" value="submit">Delete Page</button></a>
					<?php } ?>		 
							 <a href="<?php echo base_url().$page_url?>"><button type="button" class="btn btn-default" name="submit" value="submit">View Page</button></a>
					</div>
				</div><!--/span-->

			</div><!--/row-->