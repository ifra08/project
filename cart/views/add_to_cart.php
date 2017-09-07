<div style="background-color:#ddd; border-radius:7px; margin-top:24px; padding:7px;">
    <table class="table">
        <tr>
           <td colspan="2">Item ID:</td>
           <td><?= $item_id?></td>
        </tr>
        <?php
        if($num_colours>0){ 
        ?>
        <tr>
            <td>Colour:</td>
            <td>
            <?php 
				  $status=" ";
                  $additional_dd_code='class="form-control"';
				  $options = array(
								' '             => 'Please select',
								'1'             => 'Active',
								'0'             => 'Inctive',
					      	);
				echo form_dropdown('status', $colour_options,$submitted_colour,$additional_dd_code);
									 
								?>
            </td>
          
        </tr>    
        <?php 
         }
         ?>
        <tr>
             <td>Size</td>
             <td></td>
        </tr>
        <tr>
             <td>Qty</td>
             <td> 
              <div class="col-sm-8" style="padding-left:0px;">
                   <input type="text" class="form-control"  placeholder="Enter Qty"></div>
              </td>
             
        </tr>
        <tr>
             <td colspan="2" style="text-align:center;">
             
                  <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Add to Basket</button>
             </td>
        </tr>
    </table>

</div>