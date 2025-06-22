<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">Vehicles List</h1>
                <div class="card-tools">
                      <ul class="nav nav-pills ml-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-vehicles"><i class="fa fa-plus"></i> New</a>
                        </li>
                      </ul>
                </div>
            </div>
            <div class="mdl-card__supporting-text no-padding">
                <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Search</span>
                            <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Details" class="form-control" />
                        </div>
                </div>
                <br />
                <div id="result">
                       <table class="mdl-data-table mdl-js-data-table bordered-table">
                    <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">#</th>
                        <th class="mdl-data-table__cell--non-numeric">Model Name</th>
                        <th class="mdl-data-table__cell--non-numeric">Brand Name</th>
                        
                        <th class="mdl-data-table__cell--non-numeric">Rental Price</th>
                        <th class="mdl-data-table__cell--non-numeric">Duration</th>
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
                                <td class="mdl-data-table__cell--non-numeric"><a href="car-detail/<?php echo $row->id; ?>"><?php echo $row->model_name; ?></a></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->brand_name; ?></td>                                
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->rental_price; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->duration; ?></td>
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
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->title_status; ?></td>
                                <td class="mdl-data-table__cell--non-numeric"><?php echo $row->created_date; ?></td>
                                
                                <td class="mdl-data-table__cell--non-numeric">
                                    <a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="edit-vehicles btn btn-primary btn-sm color-white">
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
                                            <input type="text" name="modelname" id="modelname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Brand Name</label>
                                            <input type="text" name="brandname" id="brandname" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Duration ( Months )</label>
                                            <select name="duration" class="form-control" id="duration">
                                              <option value="">...Select...</option>
                                              <option value="1">1</option>
                                              <option value="6">6</option>
                                              <option value="12">12</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Rental Price (SGD)</label>
                                            <input type="text" name="rentalprice" id="rentalprice" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Color</label>
                                            <select name="color" class="form-control" id="color">
                                              <option value="">...Select...</option>
                                              <option value="white">White</option>
                                              <option value="black">Black</option>
                                              <option value="blue">Blue</option>
                                            </select>
                                    </div>
                                    

                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Car Design</label>
                                            <input type="text" name="cardesign" id="cardesign" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Category Status</label>
                                            <input type="text" name="category" id="category" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" name="year" id="year" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Fuel Type</label>
                                            <select class="select2-clear form-control" name="fueltype" id="fueltype" data-placeholder="Fuel Type" style="width: 100%;" required>
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getfueltype as $key => $fuel) : ?>
                                                
                                                <option value="<?= $fuel->id ?>"><?= $fuel->fuel_type ?></option>
                                                
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Body Type</label>
                                            <select class="select2 form-control" name="bodytype" id="bodytype" data-placeholder="Body Type" style="width: 100%;" >
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getbodytype as $key => $body) : ?>
                                                
                                                <option value="<?= $body->id ?>"><?= $body->body_type ?></option>
                                                
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Engine</label>
                                            <input type="text" name="engine" id="engine" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Doors</label>
                                            <input type="number" name="door" id="door" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Seats</label>
                                            <input type="text" name="seat" id="seat" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Transmission</label>
                                            <input type="text" name="transmission" id="transmission" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                            <label>Features</label>
                                            <select class="select2 form-control" name="feature[]" id="feature" data-placeholder="Features" style="width: 100%;" multiple required>
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getfeatures as $key => $feature) : ?>
                                                <option value="<?= $feature->id ?>"><?= $feature->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small>Multiple features can be selected.</small>
                                    </div>
                            </div>
                            <?php echo !empty($statusMsg)?'<p class="status-msg">'.$statusMsg.'</p>':''; ?>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Cover Photo</label>
                                    <input type="file" class="form-control" name="cover"/>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Gallery Photos</label>
                                    <input type="file" class="form-control" name="files[]" multiple/>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" type="submit" id="vehiclesform" class="btn btn-success">Save</button>
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
         <form method="post" id="vehicles_editform" enctype="multipart/form-data" action="<?php echo site_url('Dashboard/update_vehicles') ?>">
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
                                            <input type="text" name="modelname" id="modelname" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Brand Name</label>
                                            <input type="text" name="brandname" id="brandname" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Duration ( Months )</label>
                                            <select name="duration" class="form-control" id="duration">
                                              <option value="">...Select...</option>
                                              <option value="1">1</option>
                                              <option value="6">6</option>
                                              <option value="12">12</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                            <label>Rental Price (SGD)</label>
                                            <input type="text" name="rentalprice" id="rentalprice" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Color</label>
                                            <select name="color" class="form-control" id="color">
                                              <option value="">...Select...</option>
                                              <option value="white">White</option>
                                              <option value="black">Black</option>
                                              <option value="blue">Blue</option>
                                            </select>
                                    </div>
                                    

                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Car Design</label>
                                            <input type="text" name="cardesign" id="cardesign" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Category Status</label>
                                            <input type="text" name="category" id="category" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Year</label>
                                            <input type="text" name="year" id="year" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Fuel Type</label>
                                            <select class="select2-clear form-control" name="fueltype" id="fueltype" data-placeholder="Fuel Type" style="width: 100%;" >
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getfueltype as $key => $fuel) : ?>
                                                
                                                <option value="<?= $fuel->id ?>"><?= $fuel->fuel_type ?></option>
                                                
                                                <?php endforeach; ?>
                                            </select>

                                    </div>
                                    <div class="form-group">
                                            <label>Body Type</label>
                                            <select class="select2 form-control" name="bodytype" id="bodytype" data-placeholder="Body Type" style="width: 100%;" >
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getbodytype as $key => $body) : ?>
                                                
                                                <option value="<?= $body->id ?>"><?= $body->body_type ?></option>
                                                
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                    
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-12">
                                    <div class="form-group">
                                            <label>Engine</label>
                                            <input type="text" name="engine" id="engine" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Doors</label>
                                            <input type="number" name="door" id="door" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Seats</label>
                                            <input type="text" name="seat" id="seat" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Transmission</label>
                                            <input type="text" name="transmission" id="transmission" class="form-control" >
                                    </div>
                                    <div class="form-group">
                                            <label>Features</label>
                                            <select class="select2 xx form-control" name="feature[]" id="feature" data-placeholder="Features" style="width: 100%;" multiple >
                                                <option value="">&nbsp;</option>
                                                <?php foreach($getfeatures as $key => $feature) : ?>
                                                <option value="<?= $feature->id ?>"><?= $feature->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <small>Multiple features can be selected.</small>
                                    </div>
                            </div>
                            
                    </div>
                        
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
<!-- end edit Vehicles -->


<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->

<script type="text/javascript">

    $('select.xx').each(function() {    
            $(this).find("option").each(function() {     
                  var str = info.techid;
                  var substr = str.split(',');
                  for (var i = 0; i < substr.length; i++)
                  {                      
                                     
                    if (substr[i] == $(this).val()) {
                         
                      $('.xx').select2();

                    }                     
                  }
                  $("#edit_job [name='feature[]'").val(substr);   
            })
        });
</script>

<script>
$(document).ready(function(){

    load_data();
    function load_data(query)
    {
        $.ajax({
            url:"<?php echo base_url(); ?>Dashboard/fetch",
            method:"POST",
            data:{query:query},
            success:function(data){
                $('#result').html(data);
            }
        })
    }

    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            load_data();
        }
    });
});
</script>