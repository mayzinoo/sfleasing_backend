<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
		        <div class="mdl-card mdl-shadow--2dp">
		            <div class="mdl-card__title">
		                <h1 class="mdl-card__title-text">Brands List</h1>
		                <div class="card-tools">
			                  <ul class="nav nav-pills ml-auto">
			                    <li class="nav-item">
			                      <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-brands"><i class="fa fa-plus"></i> New</a>
			                    </li>
			                  </ul>
			            </div>
		            </div>
		            <div class="mdl-card__supporting-text no-padding">
		                <table class="mdl-data-table mdl-js-data-table bordered-table">
		                    <thead>
		                    <tr>
		                        <th width="100" class="mdl-data-table__cell--non-numeric">#</th>
		                        <th width="300" class="mdl-data-table__cell--non-numeric" width="150">Brand Name</th>
		                        <th width="300" class="mdl-data-table__cell--non-numeric">Brand Photo</th>
		                        <th width="100"  class="mdl-data-table__cell--non-numeric">Date</th>
		                        <th width="200" class="mdl-data-table__cell--non-numeric" width="100">Action</th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                             <?php
									$i=1;
					                    foreach($brandlist->result() as $row):
					                  ?>  
					                <tr>
					                	<td style="vertical-align:top" class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
					                	<td style="vertical-align:top" class="mdl-data-table__cell--non-numeric"><?php echo $row->brand_name; ?></td>
					                	<?php if($row->brand_photo!=""){ ?>
					                			<td class="mdl-data-table__cell--non-numeric"><img src="<?php echo base_url() .'upload/files/'.$row->brand_photo;?>" class="img-responsive brandphotos"></td>   
					                	<?php }else{ ?>
					                			<td></td>
					                	<?php } ?>
										<td style="vertical-align:top" class="mdl-data-table__cell--non-numeric"><?php echo $row->created_date; ?></td>
										<td style="vertical-align:top" class="mdl-data-table__cell--non-numeric">
											<a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="edit-brands btn btn-primary btn-xs color-white">
		                                        <i class="fa fa-edit"></i> 
		                                    </a>
											<a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_brands/'.$row->id;?>" type="button" class="delete-asset btn btn-danger btn-xs color-white">
		                                        <i class="fa fa-trash"></i> 
		                                    </a>

										</td>
									</tr> 
									 <?php
						                $i++;
						            	endforeach; ?>       
		                    </tbody>
		                </table>
		            </div>
		        </div>
		</div><!-- Brands column -->

<!-- Add Brands Modal -->
<div class="modal fade" id="modal-new-brands" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      	 <form method="post" enctype="multipart/form-data">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Add Brands</h4>
		        </div>
		        <div class="modal-body">
		          		<div class="form-group">
		                        <label>Brand Name</label>
		                        <input type="text" name="n_brandname" class="form-control" placeholder="Brand Name" required>
		                </div>
		                <div class="form-group">
		                        <label>Brand Photo</label>
		                        <input type="file" name="photo" class="form-control"multiple="true" accept="image/*" required>
		                </div>
		        </div>
		        <div class="modal-footer">
		        	<div class="form-group">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				          <button type="submit" class="btn btn-success">Save</button>
		      		</div>
		        </div>
		</form>
      </div>
      
    </div>
</div>
<!-- end brands -->

<!-- Edit Brands Modal -->
<div class="modal fade" id="modal-edit-brands" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      	 <form method="post" id="upload_editform" enctype="multipart/form-data" action="<?php echo site_url('Dashboard/update_brands') ?>">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Edit Brands</h4>
		        </div>
		        <div class="modal-body">
		        		<input type="hidden" value="" name="id"/> 
		          		<div class="form-group">
		                        <label>Brand Name</label>
		                        <input type="text" name="brandname" id="brandname" class="form-control" required>
		                </div>
		                
		                <div class="form-group" id="photo-preview">
                            <label>Brand Photo</label>
                            <div>
		                            (No photo)
		                            <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="label-photo">Upload Photo </label>
                            <div>
		                            <input name="photo" type="file" class="form-control"multiple="true" accept="image/*">
		                            <span class="help-block"></span>
                            </div>
                        </div>
		        </div>
		        <div class="modal-footer">
		        	<div class="form-group">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				          <button type="submit" id="brandsform" class="btn btn-success">Update</button>
		      		</div>
		        </div>
		</form>
      </div>
      
    </div>
</div>
<!-- end edit brands -->