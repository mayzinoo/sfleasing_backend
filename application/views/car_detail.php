<div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp">
            <div class="mdl-card__title">
                <h1 class="mdl-card__title-text">Vehicle Details</h1>                
            </div>
            <div class="mdl-card__supporting-text no-padding">
                <div class="col-md-12">
                        <div class="col-md-5 box-content">
                                <div class="model-detail">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Model Name</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->model_name; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Brand Name</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->brand_name; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Vehicle Number</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->vehicle_no; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">TNC</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->tnc; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Service Type</span>
                                        </div>
                                        <div class="col-md-8">
                                            <?php if($detailsdata->price_status=="leasing"){?>
                                                <p>: For Leasing</p>
                                            <?php }else{ ?>
                                                <p>: For Selling</p>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php if($detailsdata->price_status=="leasing"){?>
                                                <span class="mini-title">Price / Day</span>
                                            <?php }else{ ?>
                                                <span class="mini-title">Selling Price</span>
                                            <?php } ?> 
                                        </div>
                                        <div class="col-md-8">
                                            <?php if($detailsdata->price_status=="leasing"){?>
                                                <p>: $ <?php echo $detailsdata->rental_price; ?></p>
                                            <?php }else{ ?>
                                                <p>: $ <?php echo $detailsdata->selling_price; ?></p>
                                            <?php } ?> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php if($detailsdata->price_status=="leasing"){?>
                                                <span class="mini-title">Rental Package</span>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-8">
                                            <?php if($detailsdata->price_status=="leasing"){?>
                                                <p>: <?php 
                                                    $vid= $this->uri->segment(3);
                                                    $query=$this->db->query("SELECT * FROM car_package WHERE vehicle_id='$vid'");?>
                                                    <?php foreach($query->result() as $row): ?>
                                                        $ <?php echo $row->price; ?> - 
                                                        <?php echo $row->duration; ?> Months  
                                                        <?php if($row->best_status=="bestsaver"){ ?>
                                                            - Best Saver
                                                       <?php }else{ 

                                                        }?>                                               
                                                        <br/>                                            
                                                <?php endforeach; ?>  
                                                </p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Purchase Date</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->purchase_date; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Registration Date</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->registration_date; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Year</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->year; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Body</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->bodytype; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Fuel</span>    
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->fueltype; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Color</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: 
                                            <?php
                                                $colour = explode(',', $detailsdata->color);

                                                for($i=0;$i<count($colour);$i++)
                                                {
                                                    
                                                    if($colour[$i]=="#ffffff"){
                                                        echo "White"; echo " , ";
                                                    }else if($colour[$i]=="#00a4ff"){
                                                        echo "Blue"; echo " , ";
                                                    }else if($colour[$i]=="#f10a0a"){
                                                        echo "Red"; echo " , ";
                                                    }else if($colour[$i]=="#aab5bb"){
                                                        echo "Grey"; echo " , ";
                                                    }else if($colour[$i]=="#000000"){
                                                        echo "Black"; echo " , ";
                                                    }else if($colour[$i]=="#682c18"){
                                                        echo "Brown"; echo " , ";
                                                    }
                                                }
                                            ?>
                                            </p>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Engine</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->engine_type; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Doors</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->door; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Seats</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->seat_qty; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Transmission</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>: <?php echo $detailsdata->transmission; ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Features</span>
                                        </div>
                                        <div class="col-md-8">
                                            <p>:                 
                                            <?php
                                                $fea = explode(',', $detailsdata->features);
                                                for($i=0;$i<count($fea);$i++)
                                                {
                                                    echo $fea[$i];echo ",";
                                                }
                                                
                                            ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Description</span>
                                        </div>
                                        <div class="col-md-8 car_desc">
                                            <?php echo $detailsdata->description; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <span class="mini-title">Document</span>
                                        </div>
                                        <div class="col-md-8 car_docu">
                                            <p>
                                            <?php
                                                $document = explode(',', $detailsdata->document);
                                                $totaldocu=count($document)-1;
                                                for($i=0;$i<$totaldocu;$i++)
                                                {?>
                                                    <a href="<?php echo base_url() .'upload/files/'.$document[$i];?>" style="font-size: 14px;" target="_blank">
                                                    <?php echo ": ".$document[$i]."<br/>"; ?>
                                                    </a>
                                                 <?php }
                                                
                                            ?></a>
                                            </p>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                        </div>
                        <div class="col-md-7 box-content">
                                <div class="model-detail2">
                                    <div class="row">                                     
                                            <div class="minicard_title">
                                                <span>Cover Photo</span>
                                            </div>                                           
                                            <div class="sm_toppadding sm_leftsidepadding">

                                                <?php if($detailsdata->photo!=""){ ?>
                                                    <img src="<?php echo base_url() .'upload/files/'.$detailsdata->photo;?>" class="img-responsive cover-img">
                                                    <?php }else{ ?>
                                                           No Photo
                                                    <?php } ?>
                                                    <div class="sm_toppadding lg_leftsidepadding">
                                                            <a data-id="<?= $detailsdata->cid ?>" type="button" href="javascript:void(0);" class="edit-coverImage btn btn-primary btn-xs color-white">
                                                            <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="row md_toppadding">
                                        <div class="minicard_title">
                                            <span>Photo Gallery</span>
                                            <div class="card-tools">
                                                      <ul class="nav nav-pills ml-auto">
                                                        <li class="nav-item">
                                                          <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal-new-galleryImage"><i class="fa fa-plus"></i> New</a>
                                                        </li>
                                                      </ul>
                                                </div>
                                        </div>
                                            <div class="sm_toppadding">
                                                <?php
                                                    $vid=$detailsdata->cid;
                                                    $carphotos=$this->db->query("SELECT * FROM vehicle_photos WHERE vehicle_id=$vid");                    
                                                    foreach($carphotos->result() as $row):
                                                  ?>
                                                        <div class="col-md-6 sm_toppadding">
                                                            <img src="<?php echo base_url() .'upload/files/'.$row->photos;?>" class="img-responsive galleryphoto">
                                                            
                                                            <div class="sm_padding showgallery">
                                                                <a data-id="<?= $row->id ?>" type="button" href="javascript:void(0);" class="edit-galleryImage btn btn-primary btn-xs color-white">
                                                                    <i class="fa fa-edit"></i> Edit
                                                                </a>
                                                                <a onclick="return confirm('Are you sure to delete?')" href="<?php echo base_url() .'dashboard/delete_galleryImage/'.$row->id.'/'.$row->vehicle_id;?>" type="button" class="delete-asset btn btn-danger btn-xs color-white">
                                                                <i class="fa fa-trash"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                <?php 
                                                endforeach; ?>
                                               
                                            </div>
                                        
                                        
                                    </div>
                                    
                                </div>
                        </div>
                </div>
            </div>
        </div>
</div>

<!-- Add Gallery Image -->
<div class="modal fade" id="modal-new-galleryImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Gallery Photos</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="vid" value="<?php echo $this->uri->segment(3); ?>">
                        <div class="form-group">
                                <label>Gallery Photos</label>
                                <input type="file" class="form-control" name="files[]" multiple/>
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

<!-- Edit cover photo -->
<div class="modal fade" id="modal-edit-CoverImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" id="coverImage_editform" enctype="multipart/form-data" action="<?php echo site_url('Dashboard/update_coverImage') ?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Cover Images</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" value="" name="id"/>                        
                        
                        <div class="form-group" id="photo-preview">
                            <label>Cover Image</label>
                            <div>
                                    (No photo)
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="label-photo">Upload Image </label>
                            <div>
                                    <input name="cover" type="file" class="form-control"multiple="true" accept="image/*">
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


<!-- Edit Gallery Photos -->
<div class="modal fade" id="modal-edit-galleryImage" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
         <form method="post" id="galleryImage_editform" enctype="multipart/form-data" action="<?php echo site_url('Dashboard/update_galleryImage') ?>">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Edit Gallery Images</h4>
                </div>
                <div class="modal-body">
                        <input type="hidden" value="" name="id"/>    
                        <input type="hidden" value="" name="vid"/>                     
                        
                        <div class="form-group" id="photo-preview">
                            <label>Gallery Image</label>
                            <div>
                                    (No photo)
                                    <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label id="label-photo">Upload Image </label>
                            <div>
                                    <input name="cover" type="file" class="form-control"multiple="true" accept="image/*">
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