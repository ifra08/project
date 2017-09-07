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
					
					$attributes = array('class' => 'form-horizontal');
					echo form_open('store_items/delete/'.$update_id,$attributes );
				//	<form class="form-horizontal">
					?>  	 
				        <button type="button" class="btn btn-danger" name="delete" value="delete">Delete Page</button></a>
						<button type="submit" class="btn" name="submit" value="cancel">Cancel</button>
					</div>
				</div><!--/span-->

			</div><!--/row-->