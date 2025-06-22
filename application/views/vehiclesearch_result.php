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
                                foreach($searchlists->result() as $row):
                              ?>  
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $i; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><a href="dashboard/car_detail/<?php echo $row->cid; ?>"><?php echo $row->model_name; ?></a></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->brand_name; ?></td>                                
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
                                    <a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="edit-vehicles2 btn btn-primary btn-sm color-white" id="editvehi">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_vehicles/'.$row->id;?>" type="button" class="delete-asset btn btn-danger btn-sm color-white">
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
         <form method="post" id="upload_vehicles" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Vehicles</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Model Name</label>
                                            <input type="text" name="n_modelname" id="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Brand Name</label>
                                            <input type="text" name="n_brandname" id="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Price / Day ( SGD )</label>
                                            <input type="text" name="n_price" id="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Category Name</label>                                            
                                            <select class="select3-clear form-control" name="category" id="" data-placeholder="Category Name" style="width: 100%;" required>
                                                <option value="">&nbsp;</option>
                                                <?php foreach(category_list() as $key => $status) : ?>
                                                <option value="<?= $key ?>"><?= $status ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Consumption (litres/100 km)</label>
                                            <input type="text" name="n_consumption" id="consumption" class="form-control" required>
                                    </div>  
                                                                     
                                                                

                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Fuel Type</label>
                                            <select class="select2-clear form-control" name="n_fueltype" id="" data-placeholder="Fuel Type" style="width: 100%;" required>
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getfueltype as $key => $fuel) : ?>
                                                
                                                <option value="<?= $fuel->id ?>"><?= $fuel->fuel_type ?></option>
                                                
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Body Type</label>
                                            <select class="select2 form-control" name="n_bodytype" id="" data-placeholder="Body Type" style="width: 100%;" >
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getbodytype as $key => $body) : ?>
                                                
                                                <option value="<?= $body->id ?>"><?= $body->body_type ?></option>
                                                
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Engine</label>
                                            <input type="text" name="n_engine" id="" class="form-control" required>
                                    </div>
                                    <div class="row nopadding">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Doors</label>
                                                    <input type="number" name="n_door" id="" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Seats</label>
                                                    <input type="number" name="n_seat" id="" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>                                    
                                    
                                    <div class="form-group">
                                            <label>Color</label>                                            
                                            <select class="select3" name="color[]" id="" data-placeholder="Color" style="width: 100%;" multiple required>
                                                <option value="">&nbsp;</option>
                                                <?php foreach(colors_list() as $key => $status) : ?>
                                                <option value="<?= $key ?>"><?= $status ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small>Multiple colors can be selected.</small>
                                    </div>     
                                    
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">  
                                                                    
                                    <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" name="n_year" id="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Transmission</label>
                                            <input type="text" name="n_transmission" id="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Features</label>
                                            <select class="select3-clear form-control" name="feature[]" id="" data-placeholder="Features" style="width: 100%;" multiple required>
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getfeatures as $key => $feature) : ?>
                                                <option value="<?= $feature->name ?>"><?= $feature->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small>Multiple features can be selected.</small>
                                    </div>
                                    <?php echo !empty($statusMsg)?'<p class="status-msg">'.$statusMsg.'</p>':''; ?>
                                    
                                    
                                    
                            </div>                            
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Cover Photo</label>
                                <input type="file" class="form-control" name="cover" required/>
                                <span class="text-danger"><?php echo form_error('file'); ?></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gallery ( Multiple Photos can be selected )</label>
                                <input type="file" class="form-control" name="files[]" multiple/>
                            </div> 
                        </div>
                    </div>
                    <div class="col-md-12 pkginfo">
                        <h4 class="chosepkg-right"><span class="text-right btn" onclick="pkgcloneform(event)" style="float:right" ><i class="fa fa-plus"></i> Add New</span>
                        </h4>
                    </div>
                    <div id="vpkg" class="choosepackage">
                   
                    <div class="row package sm_toppadding">                    
                            <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Duration</label> 
                                        <?=form_dropdown("duration[]",$durationlist,"","class='form-control','required='required'")?>
                                    </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                    <div class="form-group">
                                        <label>Price(SGD)</label>
                                        <input type="text" name="rentalprice[]" id="" class="form-control" required>
                                    </div>  
                            </div>
                            <div class="col-md-3 col-lg-3">
                                    <div class="form-group">
                                        <label>Status</label>  
                                        <?=form_dropdown("vstatus[]",array('false'=>'...','true'=>"Best Saver"),"","class='form-control','required='required'")?>                                      
                                        
                                    </div>  
                            </div>
                            <div class="col-md-1 col-lg-1">
                                    <div class="form-group">
                                        <span class='btn btn-danger' onclick="removerpkg(event)" style="margin-top: 20px;"> x </span>
                                    </div>  
                            </div>
                        
                    </div>  
                    
                    </div><!-- end vpkg-->
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" id="vehiclesform" class="btn btn-success">Save</button>
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
         <form method="post" id="vehicles_editform" enctype="multipart/form-data" action="<?php echo site_url('dashboard/update_vehicles') ?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Vehicles</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" value="" name="id"/> 
                        <div class="row">
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Model Name</label>
                                            <input type="text" name="modelname" id="" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Brand Name</label>
                                            <input type="text" name="brandname" id="" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Price / Day ( SGD )</label>
                                            <input type="text" name="price" id="" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Category Name</label>                                            
                                            <select class="select3 form-control" name="category" id="" data-placeholder="Category Name" style="width: 100%;" required>
                                                
                                                <?php foreach($getcategory as $key => $status) : ?>
                                                <option value="<?= $key ?>"><?= $status ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Consumption (litres/100 km)</label>
                                            <input type="text" name="consumption" id="" class="form-control">
                                    </div>  
                                                                     
                                                                

                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Fuel Type</label>
                                            <select class="select2 form-control" name="fueltype" id="" data-placeholder="Fuel Type" style="width: 100%;" >
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getfueltype as $key => $fuel) : ?>
                                                
                                                <option value="<?= $fuel->id ?>"><?= $fuel->fuel_type ?></option>
                                                
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Body Type</label>
                                            <select class="select3 form-control" name="bodytype" id="" data-placeholder="Body Type" style="width: 100%;" >
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getbodytype as $key => $body) : ?>
                                                
                                                <option value="<?= $body->id ?>"><?= $body->body_type ?></option>
                                                
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Engine</label>
                                            <input type="text" name="engine" id="" class="form-control" >
                                    </div>
                                    <div class="row nopadding">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Doors</label>
                                                    <input type="number" name="door" id="" class="form-control" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Seats</label>
                                                    <input type="number" name="seat" id="" class="form-control" >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                            <label>Color</label>
                                            
                                            <select class="select4 cc" name="color[]" id="color2" data-placeholder="Color" style="width: 100%;" multiple>
                                                <option value="">&nbsp;</option>
                                                <?php foreach(colors_list() as $key => $status) : ?>
                                                <option value="<?= $key ?>"><?= $status ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small>Multiple colors can be selected.</small>
                                    </div>     
                                    
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">  
                                                                   
                                    <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" name="year" id="" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Transmission</label>
                                            <input type="text" name="transmission" id="" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Features</label>                                            
                                            <select class="select4-clear xx form-control" name="feature[]" id="feature2" data-placeholder="Features" style="width: 100%;" multiple >
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getfeatures as $key => $feature) : ?>
                                                <option value="<?= $feature->name ?>"><?= $feature->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small>Multiple features can be selected.</small>
                                    </div>
                                    
                                    
                                    
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                    <?php echo !empty($statusMsg)?'<p class="status-msg">'.$statusMsg.'</p>':''; ?>
                                    <div class="form-group" id="photo-preview">
                                        <label>Cover Photo</label>
                                        <div>
                                                (No photo)
                                                <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label id="label-photo">Upload Photo </label>
                                        <div>
                                                <input name="cover" type="file" class="form-control" multiple="true" accept="image/*">
                                                <span class="help-block"></span>
                                        </div>
                                    </div>
                            </div>
                            
                        </div>
                        <div class="col-md-12 pkginfo2">
                            <h4 class="chosepkg-right">
                                <a href="javascript:void(0);" class="text-right btn" id="add-vehicles" style="float:right" >
                                        <i class="fa fa-plus"></i> Add New
                                    </a>
                            </h4>
                        </div>
                    
                        <div id="vpkg" class="row choosepackage2">
                        <div class="col-md-12 package2 sm_toppadding">  

                                <table class="table table-striped table-valign-middle" id="vehicles-edit-table">
                                    <thead>
                                        <tr>
                                            <th>Duration</th>
                                            <th>Price(SGD)</th>                                        
                                            <th>Status</th>
                                            <th width="50">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                </table>                       
                        </div>   
                        </div><!-- end vpkg-->
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" id="" class="btn btn-success">Update</button>
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

