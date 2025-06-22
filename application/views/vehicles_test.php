<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                    <h1 class="mdl-card__title-text">Vehicles List</h1>
                    <div class="card-tools">
                        
                          <ul class="nav nav-pills ml-auto">
                            <li>
                                <div class="row">
                                <?=form_open('dashboard/vehicles_search/')?>
                                    <div class="col-md-7 col-lg-7">
                                        <input type="text" name="search_text" placeholder="Search by Model Name" class="form-control" />
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                      <button type="submit" value="submit" name="submit" class="btn btn-primary mb-2 pa">Search</button>
                                    </div>                                     
                                    <?=form_close()?>
                                </div>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-vehicles"><i class="fa fa-plus"></i> New</a>
                            </li>
                          </ul>
                    </div>
                    <br/>                    
            </div>            
                
            
            <div class="mdl-card__supporting-text no-padding">

                    <table class="mdl-data-table mdl-js-data-table bordered-table">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">#</th>
                        <th class="mdl-data-table__cell--non-numeric">Model Name</th>
                        <th class="mdl-data-table__cell--non-numeric">Brand Name</th>
                        
                        <th class="mdl-data-table__cell--non-numeric">Rental Price</th>
                        <!-- <th class="mdl-data-table__cell--non-numeric">Duration</th> -->
                        <th class="mdl-data-table__cell--non-numeric">Photo</th>
                        <th class="mdl-data-table__cell--non-numeric">Engine Type</th>
                        <th class="mdl-data-table__cell--non-numeric">Body Type</th>
                        <th class="mdl-data-table__cell--non-numeric">Year</th>
                        <th class="mdl-data-table__cell--non-numeric">Status</th>
                        <th class="mdl-data-table__cell--non-numeric">Date</th>
                        <th class="mdl-data-table__cell--non-numeric">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                             <?php
                            
                                foreach($allvehicleslist->result() as $row):
                              ?>  
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><a href="dashboard/car_detail/<?php echo $row->cid; ?>"><?php echo $row->model_name; ?></a></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->description; ?></td>                                
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->rental_price; ?></td>
                                
                                <td width="200" class="mdl-data-table__cell--non-numeric">
                                    <?php if($row->photo!=""){ ?>
                                        
                                            <img src="<?php echo base_url() .'upload/files/'.$row->photo;?>" class="img-responsive">
                                       
                                    <?php }else{ ?>
                                        No Photo
                                    <?php } ?>
                                    
                                </td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->engine_type; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->body_type; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->year; ?></td>
                                <td class="mdl-data-table__cell--non-numeric">
                                    <?php
                                       
                                        
                                        if($row->id==$row->vid){ ?>
                                            
                                                    <a class="btn btn-warning btn-xs date_status" data-id="<?= $row->avidate ?>" type="button" href="javascript:void(0);" >Already Rent</a>                                       
                                            
                                        <?php }else{ ?>
                                            
                                                <a class="btn btn-success btn-xs" type="button" href="javascript:void(0);" >Available</a>                             
                                            
                                        <?php }?>                                   
                                        
                                    </td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->created_date; ?></td>
                                
                                <td class="mdl-data-table__cell--non-numeric">
                                    <a data-id="<?= $row->cid ?>" type="button" href="javascript:void(0);" class="edit-vehicles2 btn btn-primary btn-sm color-white" id="editvehi">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_vehicles/'.$row->cid;?>" type="button" class="delete-asset btn btn-danger btn-sm color-white">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>

                                </td>
                            </tr> 
                             <?php
                                $i++;
                                endforeach; ?>       
                    </tbody>
                </table>
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
</div>


<!-- Add Vehicles Modal -->
<div class="modal fade" id="modal-new-vehicles" role="dialog">
    <div class="modal-dialog modal-xl">
    
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" enctype="multipart/form-data;charset=utf-8">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Vehicles</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                            
                            
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Description</label>
                                            <textarea cols="80" id="description" name="description" rows="10">
                                                <?php echo $page_content->message1; ?>
                                                            </textarea>
                                                            <script>

                                                                CKEDITOR.replace('description');

                                                            </script>
                                    </div>  
                                    
                            </div>                            
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

<!-- Edit Vehicles Modal -->
<div class="modal fade" id="modal-edit-vehicles" role="dialog">
    <div class="modal-dialog modal-xl">
    
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" enctype="multipart/form-data" action="<?php echo site_url('dashboard/update_vehicles') ?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Vehicles</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" value="" name="id"/> 
                        <div class="row">
                                                        
                            <div class="col-md-4 col-lg-4 col-sm-12"> 
                                    <div class="form-group">
                                            <label>Description</label>
                                            <textarea cols="80" id="edit_description" name="edit_description" rows="10">
                                                <?php echo $page_content->message1; ?>
                                                            </textarea>
                                                            <script>

                                                                CKEDITOR.replace('edit_description');

                                                            </script>
                                    </div>
                            </div>
                            
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
<!-- end edit Vehicles -->


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->



<div class="modal fade" id="modal-bookingstatus" role="dialog">
    <div class="modal-dialog">

      <div class="modal-content">
        
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Available Rental Date</h4>
                </div>
                <div class="modal-body">
                        <div id="avidate"></div>
                        
                </div>
                <div class="modal-footer">
                   
                </div>
        
      </div>
      
    </div>
</div>

