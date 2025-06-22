<div class="mdl-cell mdl-cell--8-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">Features</h1>
                <div class="card-tools">
	                  <ul class="nav nav-pills ml-auto">
	                    <li class="nav-item">
	                      <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-feature"><i class="fa fa-plus"></i> New</a>
	                    </li>
	                  </ul>
	            </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
                <table class="mdl-data-table mdl-js-data-table bordered-table">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">#</th>
                        <th width="300" class="mdl-data-table__cell--non-numeric">Feature Name</th>
                        <th class="mdl-data-table__cell--non-numeric">Date</th>
                        <th class="mdl-data-table__cell--non-numeric">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                	<?php
						$i=1;
		                    foreach($feature->result() as $row):
		                ?> 
		                    <tr>
		                        <td class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
		                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row->name; ?></td>
		                        <td class="mdl-data-table__cell--non-numeric"><?php echo $row->created_date; ?></td>
		                        <td class="mdl-data-table__cell--non-numeric">
									<a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="edit-feature btn btn-primary btn-xs color-white">
                                        <i class="fa fa-edit"></i> 
                                    </a>
									<a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_features/'.$row->id;?>" type="button" class="delete-asset btn btn-danger btn-xs color-white">
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
</div><!-- end features -->




<div class="modal fade" id="modal-new-feature" role="dialog">
    <div class="modal-dialog">
  
      <div class="modal-content">
      	 <form method="post">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Add Features</h4>
		        </div>
		        <div class="modal-body">		        		
		          		<div class="form-group">
		                        <label>Feature Name</label>
		                        <input type="text" name="n_name" class="form-control" placeholder="Name" required>
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

<div class="modal fade" id="modal-edit-feature" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
      	 <form method="post" action="<?php echo site_url('Dashboard/update_feature') ?>">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Edit Features</h4>
		        </div>
		        <div class="modal-body">
		        		<input type="hidden" value="" name="id"/> 
		          		<div class="form-group">
		                        <label>Feature Name</label>
		                        <input type="text" name="name" class="form-control" placeholder="Name" required>
		                </div>
		        </div>
		        <div class="modal-footer">
		        	<div class="form-group">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				          <button type="submit" class="btn btn-success">Update</button>
		      		</div>
		        </div>
		</form>
      </div>
      
    </div>
</div>
<!-- end feature -->